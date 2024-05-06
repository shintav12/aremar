<?php

namespace App\Models;

class CollectionsModel extends BaseModel
{

    protected $table = 'collections';
    public $fillable = ['id','name',"slug",
                        "position","status",
                        "created_by","updated_by",
                        "created_at","updated_at"];
}
