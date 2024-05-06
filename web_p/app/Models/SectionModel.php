<?php

namespace App\Models;

class SectionModel extends BaseModel
{
    protected $table = 'sections';
    public $fillable = ['id','name',"title",
                        "subtitle","slug",
                        "path","position",
                        "status",
                        "created_by","updated_by",
                        "created_at","updated_at"];
}
