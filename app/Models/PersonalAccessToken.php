<?php

namespace App\Models;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;


// declare personal access token to make a connection to the central db , to fetch the personal access token of a user
// to init the session id to store carts and cart_items
class PersonalAccessToken extends SanctumPersonalAccessToken{
    protected $connection = 'central';
}



?>