<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends BaseModel
{
    protected $table = 'orders';
    public $fillable = [
            "id",
            "user_id",
            "email",
            'name',
            "last_name",
            "address",
            "interior",
            "document_number",
            "delivered_status",
            "status",
            "created_at",
            "updated_at"];
}
