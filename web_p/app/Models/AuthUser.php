<?php

namespace App\Models;

class AuthUser extends BaseModel
{
    protected $table = 'auth_user';

   	protected $fillable = ["id","username","email","created_at","password","first_name","last_name","type","role_id"];
   	protected $hidden = ["password"];

   	public function role(){
   		return $this->hasOne("App\Models\AuthRole");
   	}
        

}