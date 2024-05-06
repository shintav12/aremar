<?php

namespace App\Models;

class AuthRoleObject extends BaseModel
{
    protected $table = 'auth_role_object';
   	public $timestamps = false;
    protected $fillable = [];

    public function scopePermission($query,$role){
        return $query->join('auth_object', 'auth_object.id', '=', 'auth_role_object.object_id')
            ->where('auth_role_object.role_id', $role)
            ->where('auth_object.status', 1)
            ->orderBy('auth_object.father_id', 'asc')
            ->orderBy('auth_object.position', 'asc')
            ->select('auth_object.*', 'auth_role_object.permission');
    }
}