<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'buying_detail_id';
    public $incrementing = true;

    protected $fillable = [
        'buying_detail_id',
        'buying_invoice_id',
        'product_name',
        'product_supplier_price',
        'exp_date',
        'quantity',
        'updated_at',
        'created_at',
    ];

    public function buying()
    {
        return $this->belongsTo(Buying::class, 'buying_invoice_id', 'buying_invoice_id');
    }
}
