<?php

namespace App\Models;

class UserModel extends BaseModel
{
    protected static $sortableField = 'position';

    protected $table = 'user';
   	public $fillable = ["id","name","status","position","created_at","updated_at"];
}
