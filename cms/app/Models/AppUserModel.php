<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppUserModel extends BaseModel
{
    protected $table = 'app_users';
    public $fillable = [
            "id",
            "name",
            "last_name",
            'email',
            "address",
            "password",
            "ubigeo",
            "interior",
            "facebook_login",
            "google_login",
            "status",
            "created_at",
            "updated_at"];
}
