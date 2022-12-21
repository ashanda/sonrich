<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p2p extends Model
{
    use HasFactory;
    protected $table = 'p2p_transection';
    protected $fillable = [
        'id'
    ];
}
