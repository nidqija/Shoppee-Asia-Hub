<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravel\Sanctum\HasApiTokens; // 1. Import the Sanctum trait

class User extends Authenticatable
{
   use HasUuids , HasApiTokens, HasFactory; // 2. Use the Sanctum trait

   protected $connection = 'central';

   protected $fillable = [
    'email',
    'password',
    'phone_number',
    'home_region',
    'role',
   ];

   protected $hidden = [
    'password',
    'remember_token',
   ];

   // ensure the password is hashed when being set
   protected function casts() : array {
      return [
         'password' => 'hashed',
      ];
   }

}
