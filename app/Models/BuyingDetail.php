<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'buying_detail_id';

    protected $fillable = [
        'buying_detail_id',
        'buying_invoice_id',
        'product_name',
        'product_supplier_price',
        'exp_date',
        'quantity',
    ];

    public function buyingInvoice()
    {
        return $this->belongsTo(Buying::class, 'buying_invoice_id');
    }
}
