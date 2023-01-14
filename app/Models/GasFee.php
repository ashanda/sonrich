<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasFee extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'gas_fee',
        'last_earn'
    ];
}
