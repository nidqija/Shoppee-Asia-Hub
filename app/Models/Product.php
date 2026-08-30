<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Product extends Model {


    use HasUuids;

    protected $fillable = [
        'title',
        'description',
        'price',
        'category_slug',
        'stock_quantity',
        'status',
        'region_code',
        'seller_id',
    ];

    
}



?>