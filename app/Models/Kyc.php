<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'mobile_number1',
        'mobile_number2',
        'id_docs_type',
        'id_doc_front',
        'id_doc_back',
        'country',
        'address', 
        'bank_name',
        'branch_name',
        'bank_acount_number',
        'citizen',
    ];

    protected $hidden = [
        'user_id',
        'status',
        'remember_token',
    ];
}
