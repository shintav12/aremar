<?php

namespace App\Repository;

use App\Models\CategoryModel;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository
{

    public const MODEL_CLASS = CategoryModel::class;

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

            $data["slug"] = $this->model->get_slug($data["name"],"categories");
            $category = $this->model->create([
                                    "name"=>$data['name'],
                                    "slug"=>$data['slug']
                                ]);

            return "";
        });

    }

    public function update(array $data, $id)
    {
        $data["slug"] = $this->model->get_slug_id($data["name"],"categories",$id);
        $category = $this->model->findOrFail($id);
        return DB::transaction(function () use ($data, $category) {
            $category->update([
                "name"=>$data['name'],
                "slug"=>$data['slug']
            ]);

            return "";
        });
    }
}
