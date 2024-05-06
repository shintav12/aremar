<?php

namespace App\Models;

class CategoryModel extends BaseModel
{

    protected $table = 'categories';
    public $fillable = ['id','name',"slug",
                        "position","status",
                        "created_by","updated_by",
                        "created_at","updated_at"];
}
