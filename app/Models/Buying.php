<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Buying extends Model
{
    use HasFactory;

    protected $primaryKey = 'buying_invoice_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'buying_invoice_id',
        'order_date',
        'supplier_name',
        'updated_at',
        'created_at',
    ];
    
    public function buyingDetail()
    {
        return $this->hasMany(BuyingDetail::class, 'buying_invoice_id', 'buying_invoice_id');
    }

    public function getTotalAmount()
    {
        return DB::table('buying_details')
            ->where('buying_invoice_id', $this->buying_invoice_id)
            ->selectRaw('SUM(product_supplier_price * quantity) as total')
            ->value('total') ?? 0;
    }
}
