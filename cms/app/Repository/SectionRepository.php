<?php

namespace App\Repository;

use App\Models\MetalsModel;
use App\Models\SectionModel;
use App\Utils\imageUploader;
use Illuminate\Support\Facades\DB;

class SectionRepository extends BaseRepository
{

    public const MODEL_CLASS = SectionModel::class;

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

            $data["slug"] = $this->model->get_slug($data["name"],"sections");
            $section = $this->model->create([
                                    "name"=>$data['name'],
                                    "title"=>$data['title'],
                                    "btn_text"=>$data['btn_text'],
                                    "btn_link"=>$data['btn_link'],
                                    "subtitle"=>$data['subtitle'],
                                    "path"=>" ",
                                    "slug"=>$data['slug']
                                ]);

            if(array_key_exists("path", $data) && ($data["path"] != null)){
                $path = imageUploader::upload($section,$data["path"],"sections");
                $section->update([
                    "path"=>$path
                ]);
            }
        });

    }

    public function update(array $data, $id)
    {
        $data["slug"] = $this->model->get_slug_id($data["name"],"sections",$id);
        $section = $this->model->findOrFail($id);
        if(array_key_exists("path", $data) && ($data["path"] != null)){
            $path = imageUploader::upload($section,$data["path"],"sections");
            $section->update([
                "path"=>$path
            ]);
        }
        return DB::transaction(function () use ($data, $section) {
            $section->update([
                "name"=>$data['name'],
                "title"=>$data['title'],
                "btn_text"=>$data['btn_text'],
                "btn_link"=>$data['btn_link'],
                "subtitle"=>$data['subtitle'],
                "slug"=>$data['slug']
            ]);
            return "";
        });
    }
}
