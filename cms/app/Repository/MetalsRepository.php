<?php

namespace App\Repository;

use App\Models\MetalsModel;
use Illuminate\Support\Facades\DB;

class MetalsRepository extends BaseRepository
{

    public const MODEL_CLASS = MetalsModel::class;

    public function datatable()
    {
        return $this->model->where("status", "!=", 2)
            ->get(['id', 'name', 'status', 'position',
                DB::raw("date_format(created_at,'%d/%m/%Y %H:%i:%s') as created"),
                DB::raw("date_format(updated_at,'%d/%m/%Y %H:%i:%s') as updated")]);
    }

    public function create(array $data,$type)
    {
        return DB::transaction(function () use ($data,$type) {

            $data["slug"] = $this->model->get_slug($data["name"],"metals");
            $metal = $this->model->create([
                                    "name"=>$data['name'],
                                    "slug"=>$data['slug']
                                ]);

            return "";
        });

    }

    public function update(array $data, $id)
    {
        $data["slug"] = $this->model->get_slug_id($data["name"],"metals",$id);
        $metal = $this->model->findOrFail($id);
        return DB::transaction(function () use ($data, $metal) {
            $metal->update([
                "name"=>$data['name'],
                "slug"=>$data['slug']
            ]);

            return "";
        });
    }
}
