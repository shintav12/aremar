<?php

namespace App\Models;

class CategoryModel extends BaseModel
{
    use \Rutorika\Sortable\SortableTrait;
    protected static $sortableField = 'position';

    protected $table = 'categories';
    public $fillable = ['id','name',"slug",
                        "position","status",
                        "created_by","updated_by",
                        "created_at","updated_at"];
}
