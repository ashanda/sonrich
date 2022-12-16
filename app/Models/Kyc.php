<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    use HasFactory;
    protected $fillable = [
        'uid',
        'email',
        'fname',
        'lname',
        'phone_number_one',
        'phone_number_two',
        'id_doc',
        'id_front_image',
        'id_back_image',
        'country',
        'bank_name',
        'branch_name',
        'acount_number',
        'citizen_srilanka',
    ];
}
