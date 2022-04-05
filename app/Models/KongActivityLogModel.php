<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KongActivityLogModel extends Model
{
    use HasFactory;
    protected $table = 'kong_activity_logs';

    // fillable
    protected $fillable = [
        'id',
        'status'
    ];
}
