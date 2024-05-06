<?php

namespace App\Models;

class AuthRole extends BaseModel
{
    protected $table = 'auth_role';
    protected $fillable = ['id','name','status','created_at',"updated_at"];

    public function users()
    {
        return $this->hasMany('App\Models\AuthUser');
    }
    
    
    
}