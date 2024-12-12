<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_service';

    protected $fillable = [
        'service_name',
        'service_price',
        'supplier_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
}

