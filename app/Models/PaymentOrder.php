<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PaymentOrder extends Model {


    use HasUuids;

    protected $fillable = [
        'user_id',
        'product_id',
        'status',
        'total_item',
        'price',
        'user_id'
    ];

    // function to map the user id to a user name from User Model
    public function userId() : BelongsTo{
        return $this -> belongsTo(User::class , 'user_id');
    }

    
}



?>