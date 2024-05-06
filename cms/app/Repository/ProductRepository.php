<?php

namespace App\Repository;

use App\Models\MetalsModel;
use App\Models\ProductImageModel;
use App\Models\ProductModel;
use App\Models\SectionModel;
use App\Utils\imageUploader;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository
{

    public const MODEL_CLASS = ProductModel::class;

    public function datatable()
    {
        return $this->model->where("status", "!=", 2)
            ->get(['id', 'name', 'status',
                DB::raw("date_format(created_at,'%d/%m/%Y %H:%i:%s') as created"),
                DB::raw("date_format(updated_at,'%d/%m/%Y %H:%i:%s') as updated")]);
    }

    public function create(array $data,$type)
    {
        return DB::transaction(function () use ($data,$type) {

            $data["slug"] = $this->model->get_slug($data["name"],"products");
            $metals = MetalsModel::get();
            $metals_array = [];

            foreach ( $metals as $key => $value){
                if(isset($data["metals_".$value->id]) && !is_null($data["metals_".$value->id])){
                    $metals_array[] = " ".$value->id." ";
                }
            }

            $metals_save = implode(",", $metals_array);

            $sections = SectionModel::where('nav',1)->get();
            $sections_array = [];

            foreach ( $sections as $key => $value){
                if(isset($data["sections_".$value->id]) && !is_null($data["sections_".$value->id])){
                    $sections_array[] = " ".$value->id." ";
                }
            }

            $sections_save = implode(",", $sections_array);
            $product = $this->model->create([
                                    "name"=>$data['name'],
                                    "price"=>$data['price'],
                                    "collection_id"=>$data['collection_id'],
                                    "category_id"=>$data['category_id'],
                                    "description"=>$data['description'],
                                    "short_description"=>$data['short_description'],
                                    "slug"=>$data['slug'],
                                    "metals" => $metals_save,
                                    "sections" => $sections_save,
                                    "path"=>" ",
                                    "alt_path"=>" ",
                                ]);

            if(array_key_exists("path", $data) && ($data["path"] != null)){
                $path = imageUploader::upload($product,$data["path"],"products");
                $product->update([
                    "path"=>$path
                ]);
            }

            if(array_key_exists("alt_path", $data) && ($data["alt_path"] != null)){
                $path = imageUploader::upload($product,$data["alt_path"],"products_alt");
                $product->update([
                    "alt_path"=>$path
                ]);
            }



            if ( array_key_exists('extraproduct',$data) ){
                foreach ($data['extraproduct'] as $key => $value){
                    $product_image = ProductImageModel::create([
                        "product_id"=>$product->id,
                        "path"=>" ",
                        "alt"=>$data["alt"][$key]
                    ]);
                    $path = imageUploader::upload($product_image, $value, 'product_images');
                    $product_image->update([
                        "path"=>$path
                    ]);
                }
            }
        return "";
        });

    }

    public function update(array $data, $id)
    {
        $data["slug"] = $this->model->get_slug_id($data["name"],"products",$id);
        $product = $this->model->findOrFail($id);
        if(array_key_exists("path", $data) && ($data["path"] != null)){
            $path = imageUploader::upload($product,$data["path"],"products");
            $product->update([
                "path"=>$path
            ]);
        }
        if(array_key_exists("alt_path", $data) && ($data["alt_path"] != null)){
            $path = imageUploader::upload($product,$data["alt_path"],"products_alt");
            $product->update([
                "alt_path"=>$path
            ]);
        }

        $aux = ProductImageModel::where("product_id",$product->id)->get(["id","status"]);

        foreach ( $aux as $key => $value ){
            $value->update(["status"=>0]);
        }
        if ( array_key_exists("image_id", $data) ) {
            foreach ($data['image_id'] as $key => $value) {
                if ($value == 0) {
                    if (isset($data['extraproduct'][$key])) {
                        $image_value = ProductImageModel::create([
                            "product_id"=>$product->id,
                            "path"=>" ",
                            "alt"=>$data["alt"][$key]
                        ]);
                        $path = imageUploader::upload($image_value, $data['extraproduct'][$key],"product_images");
                        $image_value->update(["path"=>$path]);
                    }
                } else {
                    if (isset($data['extraproduct'][$key])) {
                        $img = ProductImageModel::where("product_id",$product->id)
                                                ->where("id",$value)
                                                ->first();
                        $path = imageUploader::upload($img, $data['extraproduct'][$key],"product_images");
                        $img->update(["path"=>$path,"status"=>1,"alt"=>$data["alt"][$key]]);

                    } else {
                        $img = ProductImageModel::where("product_id",$product->id)
                                                ->where("id",$value)
                                                ->first();
                        $img->update(["status"=>1,"alt"=>$data["alt"][$key]]);
                    }
                }
            }
            $delete = ProductImageModel::where("product_id",$product->id)
                                    ->where("status",0)
                                    ->delete();
        }


        return DB::transaction(function () use ($data, $product) {
            $metals = MetalsModel::get();
            $metals_array = [];
            foreach ( $metals as $key => $value){
                if(isset($data["metals_".$value->id]) && !is_null($data["metals_".$value->id])){
                    $metals_array[] = " ".$value->id." ";
                }
            }

            $metals_save = implode(",", $metals_array);

            $sections = SectionModel::where('nav',1)->get();
            $sections_array = [];

            foreach ( $sections as $key => $value){
                if(isset($data["sections_".$value->id]) && !is_null($data["sections_".$value->id])){
                    $sections_array[] = " ".$value->id." ";
                }
            }

            $sections_save = implode(",", $sections_array);
            $product->update([
                "name"=>$data['name'],
                "price"=>$data['price'],
                "collection_id"=>$data['collection_id'],
                "category_id"=>$data['category_id'],
                "description"=>$data['description'],
                "metals" => $metals_save,
                "sections" => $sections_save,
                "short_description"=>$data['short_description'],
                "slug"=>$data['slug'],
            ]);
            return "";
        });
    }
}
