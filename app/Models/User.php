<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sri_number',
        'fname',
        'lname',
        'email',
        'parent',
        'password',
        'google2fa_secret',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'parent',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /** 

     * Interact with the user's first name.

     *

     * @param  string  $value

     * @return \Illuminate\Database\Eloquent\Casts\Attribute

     */

     protected function google2faSecret(): Attribute

     {
 
         return new Attribute(
 
             get: fn ($value) =>  decrypt($value),
 
             set: fn ($value) =>  encrypt($value),
 
         );
 
     }

     public function user_oder(){
        return $this->hasMany('App\Models\oder', 'user_id')->whereIn('status', [1, 2]);
    }
}
