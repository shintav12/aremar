<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repository;
use App\Models\AuthRoleObject;
use Illuminate\Support\Facades\DB;

/**
 * Description of AuhtRoleRepository
 *
 * @author Luis
 */
class AuhtRoleRepository extends BaseRepository{
    public const MODEL_CLASS = \App\Models\AuthRole::class;


    public function perms($id){
        $perms =  DB::select(DB::raw('select ao.id,ao.name,ao.father_id, auo.object_id
                                    from auth_object ao
                                    left join auth_role_object auo on auo.object_id = ao.id and auo.role_id = '.$id.'
                                    order by ao.position'));
        return $perms;
    }

    public function datatable(){
        return $this->model->where("status","!=",2)
                                ->get(['id','name','status',
                                DB::raw("date_format(created_at,'%d/%m/%Y %H:%i:%s') as created"),
                                DB::raw("date_format(updated_at,'%d/%m/%Y %H:%i:%s') as updated")]);
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
    public function create(array $data, $type)
    {
      $this->model->create([
            "name"=>$data["name"],
            "status"=>1,
      ]);
      return "";
    }

    public function update(array $data, $id)
    {
        $role = $this->model->findOrFail($id);
        DB::transaction(function () use ($data, $role) {
             $role->update([
                        "name"=>$data['name']
                    ]);
            return "";
        });
    }
}
