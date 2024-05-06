<?php

namespace App\Repository;

use App\Models\OfferModel;
use App\Utils\imageUploader;
use Illuminate\Support\Facades\DB;

class OfferRepository extends BaseRepository
{

    public const MODEL_CLASS = OfferModel::class;

    public function datatable()
    {
        return $this->model->where("status", "!=", 2)
            ->get(['id', 'name', 'status',
                DB::raw("date_format(created_at,'%d/%m/%Y %H:%i:%s') as created"),
                DB::raw("date_format(updated_at,'%d/%m/%Y %H:%i:%s') as updated")]);
    }

    public function create(array $data,$type)
    {
        $data["final_date"] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['final_date']).'00:00:00'));
        return DB::transaction(function () use ($data,$type) {
            $offer = $this->model->create([
                                    "product_id"=>$data['product_id'],
                                    "name"=>$data["name"],
                                    "price"=>$data["price"],
                                    "final_date"=>$data["final_date"],
                                    "path" => " "
                                ]);
            if(array_key_exists("path", $data) && ($data["path"] != null)){
                $path = imageUploader::upload($offer,$data["path"],"offers");
                $offer->update([
                    "path"=>$path
                ]);
            }
            return "";
        });

    }

    public function update(array $data, $id)
    {
        $data["final_date"] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['final_date']).'00:00:00'));
        $offers = $this->model->findOrFail($id);
        if(array_key_exists("path", $data) && ($data["path"] != null)){
            $path = imageUploader::upload($offers,$data["path"],"offers");
            $offers->update([
                "path"=>$path
            ]);
        }
        return DB::transaction(function () use ($data, $offers) {
            $offers->update([
                "product_id"=>$data['product_id'],
                "name"=>$data["name"],
                "price"=>$data["price"],
                "final_date"=>$data["final_date"]
            ]);
            return "";
        });
    }
}
