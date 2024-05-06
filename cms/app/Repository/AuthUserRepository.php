<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repository;
use App\Models\AuthUser;
use App\Models\AuthRoleObject;
use Illuminate\Support\Facades\DB;
use \Session;
use Illuminate\Support\Facades\Hash;

/**
 * Description of AuthUserRepository
 *
 * @author Luis
 */
class AuthUserRepository extends BaseRepository{

    public const MODEL_CLASS = AuthUser::class;


    public function verify($username,$password,&$user){
        $user = $this->model->where('username','=',$username)->first();
        return ($user && Hash::check($password,$user->password));
    }


    public function datatable(){
        return $this->model->join("auth_role","auth_role.id","=","auth_user.role_id")
                            ->where("auth_user.status","!=",2)
                            ->select(["auth_user.id",
                            "auth_user.username",
                            "auth_user.first_name",
                            "auth_user.status",
                            "auth_user.last_name",
                            "auth_role.name as role",
                            DB::raw("date_format(auth_user.created_at,'%d/%m/%Y %H:%i:%s') as created"),
                            DB::raw("date_format(auth_user.updated_at,'%d/%m/%Y %H:%i:%s') as updated")]);
    }


    public function datatableView(){
        return ["id","username","first_name","last_name","role","created_at","updated_at",];
    }

    public function permissions(&$user){
        $permissions =  DB::select(DB::raw('select ao.id,ao.name,ao.father_id, auo.object_id, ao.menu_active, ao.location,ao.position,ao.icon,auo.permission,ao.father
                            from auth_object ao
                            left join auth_role_object auo on auo.object_id = ao.id
                                where ao.status = 1 and auo.role_id = '.$user->role_id.'
                            order by ao.position'));
        $data_perms = [];
        $perms = [];
        foreach ($permissions as $k => $v) {
            $perms[$v->id] = array(
                'id' => $v->id,
                'name' => $v->name,
                'menu_active' => $v->menu_active,
                'location' => $v->location,
                'position' => $v->position,
                'icon' => $v->icon,
                'permission' => $v->permission,
                'children' => array(),
            );
            if($v->father_id == 0 && $v->father == 0){
                $data_perms[$v->id] = array(
                    'id' => $v->id,
                    'name' => $v->name,
                    'menu_active' => $v->menu_active,
                    'location' => $v->location,
                    'position' => $v->position,
                    'icon' => $v->icon,
                    'permission' => $v->permission,
                    'children' => array(),
                );
            }else if($v->father_id != 0 && $v->father == 0){
                if (isset($data_perms[$v->father_id])) {
                    $data_perms[$v->father_id]['children'][$v->id] = array(
                        'id' => $v->id,
                        'name' => $v->name,
                        'menu_active' => $v->menu_active,
                        'location' => $v->location,
                        'position' => $v->position,
                        'permission' => $v->permission,
                        'icon' => $v->icon,
                    );
                }
            }else{
                $data_perms[$v->id] = array(
                    'id' => $v->id,
                    'name' => $v->name,
                    'menu_active' => $v->menu_active,
                    'location' => $v->location,
                    'position' => $v->position,
                    'icon' => $v->icon,
                    'permission' => $v->permission,
                    'children' => array(),
                );
            }
        }

        $user->permissions = $data_perms;
        $user->permissions_full = $perms;

        return "";
    }

    public function save_perms($request) {
        extract($request);
        AuthRoleObject::where('role_id',$id)->delete();
        for ($i = 0 ; $i < count($perms_check); $i++) {
            if($perms_check[$i] == "true")
                $data[] = [
                    "role_id" => $id,
                    "object_id" => intval($object_id[$i])
                ];
        }
        AuthRoleObject::insert($data);
        return true;
    }

    public function _create(array $data, $type){
        $data["password"] = Hash::make($data["password"]);

        $auth_user = $this->model->create([
            "username"=>$data['username'],
            "password"=>$data['password'],
            "email"=>$data['email'],
            "first_name"=>$data['first_name'],
            "last_name"=>$data['last_name'],
            "role_id"=>$data['role_id'],
        ]);

        return "";


    }

    protected function _update(array $data, $resource){

        $resource->update([
            "username"=>$data['username'],
            "email"=>$data['email'],
            "first_name"=>$data['first_name'],
            "last_name"=>$data['last_name'],
            "role_id"=>$data['role_id'],
        ]);

        if(array_key_exists("password", $data) && $data['password'] != null ){
            $data["password"] = Hash::make($data["password"]);
            $resource->update([
                "password"=>$data['password'],
            ]);
        }

        return "";

    }
}
