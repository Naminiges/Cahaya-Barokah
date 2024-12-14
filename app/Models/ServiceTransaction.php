<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTransaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'invoice_number',
        'entry_date',
        'cashier_id',
        'customer_id',
        'cashier_name',
        'customer_name',
        'service_ids',
        'quantities',
        'total_price',
        'status'
    ];

    protected $casts = [
        'service_ids' => 'array',
    ];
    
}
