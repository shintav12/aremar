<?php

namespace App\Models;
class ProductModel extends BaseModel
{
    protected $table = 'products';
    public $fillable = ['id','name',"description",'price',
                        "short_description","slug",
                        "path","alt_path",
                        "status",
                        "created_by","updated_by",
                        "created_at","updated_at"];
}
