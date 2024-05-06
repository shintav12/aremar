<?php

namespace App\Models;

class UserModel extends BaseModel
{
    use \Rutorika\Sortable\SortableTrait;
    protected static $sortableField = 'position';

    protected $table = 'user';
   	public $fillable = ["id","name","status","position","created_at","updated_at"];
}
