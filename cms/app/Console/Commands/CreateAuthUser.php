<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AuthUser;
use App\Models\AuthRole;
use App\Models\AuthObject;
use App\Models\AuthRoleObject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;


class CreateAuthUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->createUser();
    }

    protected function createPerms($role_id){
        $results = DB::select("SHOW TABLES");
        $position = 0;
        foreach ($results as $key => $value) {
            $position++;
            $keys  = array_keys(get_object_vars($value));
            $table = $value->{$keys[0]};
            $object = AuthObject::where(array("menu_active"=>$table))->first(["id"]);
            if(!$object){
                $object = new AuthObject();
                $object->name = $table;
                $object->menu_active = $table;
                $object->description = "";
                $object->location = $table;
                $object->father_id = 0;
                $object->position = $position;
                $object->father = 0;
                $object->status = 1;
                $object->save();
            }
            $has = AuthRoleObject::where(array("role_id"=>$role_id,"object_id"=>$object->id))->first(["role_id"]);
            if(!$has){
                $has = new AuthRoleObject();
                $has->role_id = $role_id;
                $has->object_id = $object->id;
                $has->permission = "A";
                $has->save();
            }
        }
    }

    protected function createUser(){
        $this->info('Creating superuser');
        $auth_user = AuthUser::where(array("username"=>"admin"))->first(["id"]);
        if(!$auth_user){
            $password = $this->secret('Password:');
            $email = $this->ask("Email:");
            $validator = Validator::make([
                'password' => $password,
                'email' => $email            
            ], [
                'email' => ['required', 'email',],
                'password' => ['required', 'min:7'],
            ]);

            if ($validator->fails()) {
                $this->info('Super User can not be created. See error messages below:');
                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }
                $this->handle();
            }else{
                $auth_role = AuthRole::where(array("name"=>"Admin"))->first(["id"]);
                if(!$auth_role){
                    $auth_role = new AuthRole();    
                    $auth_role->name = "Admin";
                    $auth_role->status = 1;
                    $auth_role->save();
                }
                $this->createPerms($auth_role->id);
                $auth_user = new AuthUser();
                $auth_user->username  = "admin";
                $auth_user->password = Hash::make($password);
                $auth_user->email = $email;
                $auth_user->first_name = "Dispositivos";
                $auth_user->last_name = "+1";
                $auth_user->status = 1;
                $auth_user->role_id = $auth_role->id;
                $auth_user->save();
                $this->info('Superuser was created successfully');
            }
        }else{
            $this->info('Superuser is already created');
        }
    }
}
