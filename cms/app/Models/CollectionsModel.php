<?php

namespace App\Models;

class CollectionsModel extends BaseModel
{
    use \Rutorika\Sortable\SortableTrait;
    protected static $sortableField = 'position';

    protected $table = 'collections';
    public $fillable = ['id','name',"slug",
                        "position","status",
                        'offer',
                        "created_by","updated_by",
                        "created_at","updated_at"];
}
