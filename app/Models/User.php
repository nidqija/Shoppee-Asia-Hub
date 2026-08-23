<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable
{
   use HasUuids;

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

}
