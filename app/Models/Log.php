<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_id',
        'user_id',
        'action',
        'affected_table',
        'affected_id',
        'affected_name',
        'old_value',
        'new_value',
        'log_time',
    ];
}
