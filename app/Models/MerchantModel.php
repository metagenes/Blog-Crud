<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantModel extends Model
{
    use HasFactory;
    protected $table = 'merchant';

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'service_type',
        'fee',
        'merchant_id',
    ];

}


