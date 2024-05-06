<?php

namespace App\Models;

class OfferModel extends BaseModel
{
    protected $table = 'offers';
    public $fillable = [
            "id",
            "product_id",
            "name",
            'path',
            "price",
            "status",
            "final_date",
            "created_at",
            "updated_at"];
}
