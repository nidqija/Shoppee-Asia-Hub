<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class CartItems extends Model {


    use HasUuids;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
        'created_at',
    ];

    // function to map the user id to a user name from User Model
    public function cartId() : BelongsTo{
        return $this -> belongsTo(Carts::class , 'cart_id');
    }

    public function productId() : BelongsTo{
        return $this -> belongsTo(Product::class , 'product_id');
    }


    // function to get the checkout item amount
    public function getCheckoutItemAmount($productId) : int {
        $cartItem = $this->where('product_id', $productId)->count();
        return $cartItem ? $cartItem : 0;
    }

    // function to get the product name by mapping through cart items to product model
    public function product() : BelongsTo{
        return $this -> belongsTo(Product::class , 'product_id');
    }

    

    
}



?>