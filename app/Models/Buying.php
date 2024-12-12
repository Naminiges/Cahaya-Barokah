<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buying extends Model
{
    use HasFactory;

    protected $primaryKey = 'buying_invoice_id';

    protected $fillable = [
        'buying_invoice_id',
        'order_date',
        'supplier_name',
    ];

    public function buyingInvoiceDetail()
    {
        return $this->hasMany(BuyingDetail::class, 'buying_invoice_id');
    }
}
