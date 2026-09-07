<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


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

    // function to map the seller id to a seller name from User Model
    public function seller() : BelongsTo{
        return $this-> belongsTo(User::class, 'seller_id');
    }

    
}



?>