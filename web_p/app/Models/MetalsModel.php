<?php

namespace App\Models;

class MetalsModel extends BaseModel
{

    protected $table = 'metals';
    public $fillable = ['id','name',"slug",
                        "position","status",
                        "created_by","updated_by",
                        "created_at","updated_at"];
}
