<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetailModel extends BaseModel
{
    protected $table = 'order_detail';
    public $fillable = [
            "id",
            "product_id",
            "order_id",
            'metal_id',
            "quantity",
            "price",
            "status",
            "created_at",
            "updated_at"];
}
