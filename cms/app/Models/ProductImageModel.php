<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImageModel extends Model
{
    protected $table = 'product_images';
    public $fillable = ['id','product_id',
                        "path", "status",
                        "created_by","updated_by",
                        "created_at","updated_at"];
}
