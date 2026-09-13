<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Carts extends Model {


    use HasUuids;

    protected $fillable = [
        'user_id',
        'session_id',
        'currency',
        'created_at',
    ];

    // function to map the user id to a user name from User Model
    public function userId() : BelongsTo{
        return $this -> belongsTo(User::class , 'user_id');
    }

    
}



?>