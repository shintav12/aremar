<?php

namespace App\Models;

class SectionModel extends BaseModel
{
    use \Rutorika\Sortable\SortableTrait;
    protected static $sortableField = 'position';

    protected $table = 'sections';
    public $fillable = ['id','name',"title",
                        "subtitle","slug",
                        "path","position",
                        "btn_text","btn_link",
                        "status",
                        "created_by","updated_by",
                        "created_at","updated_at"];
}
