<?php

namespace App\Repository;

use App\Models\Department;
use App\Models\UserModel;
use App\Utils\Utils;
use Illuminate\Support\Facades\DB;
use Session;

class UserRepository extends BaseRepository
{

    public const MODEL_CLASS = UserModel::class;

    public function datatable()
    {
        return $this->model->where("status", "!=", 2)
            ->get(['id', 'name', 'status', 'position',
                DB::raw("date_format(created_at,'%d/%m/%Y %H:%i:%s') as created"),
                DB::raw("date_format(updated_at,'%d/%m/%Y %H:%i:%s') as updated")]);
    }

    // public function find($id)
    // {
    //     $data["details"] = UserDetail
    //     $data["response"] $this->model->findOrFail($id);
    //     return $data;
    // }



    // public function update(array $data, $id)
    // {
    //     $resource = $this->model->findOrFail($id);
    //     return DB::transaction(function () use ($data, $resource) {
    //         $code_exist = $this->model->where('code',$data["code"])->where("status","!=",2)->where("id","!=",$resource->id)->first(["id"]);
    //         if($code_exist){
    //             return "NOT_UNIQUE";
    //         }else{
    //             return parent::update($data,$resource->id);
    //         }
    //     });
    // }
}
