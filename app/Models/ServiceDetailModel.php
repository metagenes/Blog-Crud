<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetailModel extends Model
{
    use HasFactory;
    protected $table = 'service_detail';

    protected $fillable = [
        'service_detail_id',
        'service_id',
        'service_name',
    ];

}
