<?php

namespace App\Models;

class Metas extends BaseModel
{
    protected $table = 'metas';
    public $fillable = ['id','object_id',"type",
                        "meta_index","meta_follow",
                        "fb_title","fb_description",
                        "tw_title","tw_description",
                        "meta_keywords","meta_title",
                        "meta_description","meta_title_web",
                        "path","created_at","updated_at"];
    public $timestamps = false;
}
