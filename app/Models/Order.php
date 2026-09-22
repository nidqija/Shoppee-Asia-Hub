<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Order extends Model {
    

    use HasUuids;


    // fields for order logs table
    protected $fillable = [
        "user_id",
        "order_code",
        "shipping_address",
        "amount",
        "currency",
        "payment_method",
        "payment_status",
        "invoice_id",
        "status",
        "shipped_at",
        "completed_at",
    ];


    // additional constraints for amount , shipped at and completed at 
    protected function casts() : array {
        return [
            'amount' => 'decimal:2',
            'shipped_at' => 'datetime',
            'completed_at' => 'datetime'
        ];
    }


    // relation key declaration with user table for order table
    public function userId() : BelongsTo {
        return $this->belongsTo(User::class, "user_id");
    }




    
}



?>