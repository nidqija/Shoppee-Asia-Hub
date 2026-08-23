<?php

// model in laravel is used to interact with the database.
// represents a table in the database and provides methods to perform CRUD operations on that table.

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Region extends Model 
{
    protected $connection = 'central';
    protected $primaryKey = 'id';
    
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'code',
        'name',
        'currency_code',
        'shard_connection',
        'is_active',
    ];
}




?>