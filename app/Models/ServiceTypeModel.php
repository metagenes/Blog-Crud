<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTypeModel extends Model
{
    use HasFactory;
    protected $table = 'service_type';

    protected $fillable = [
        'service_id',
        'service_type',
        'bank_name',
    ];
}
