<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('suppliers')->insert([
            ['supplier_id' => 'SMP', 'name' => 'Sempurna', 'contact_name' => 'Supplier Sempurna', 'phone' => '082362737878', 'address' => 'Jl.Wahidin No.15'],
            ['supplier_id' => 'RKA', 'name' => 'Rezeki Kencana Abadi', 'contact_name' => 'Gas Rezeki', 'phone' => '', 'address' => ''],
        ]);

        DB::table('services')->insert([
            ['service_name' => 'Gas Elpiji 3kg', 'service_price' => 17000, 'stock' => 300, 'supplier_id' => 'RKA'],
            ['service_name' => 'Aqua Galon 19l', 'service_price' => 22000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Beras Lemon 5kg', 'service_price' => 62000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Beras Lemon 10kg', 'service_price' => 121000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Aqua 1500ml', 'service_price' => 6000, 'stock' => 25, 'supplier_id' => 'SMP'],
            ['service_name' => 'Aqua 600ml', 'service_price' => 4000, 'stock' => 25, 'supplier_id' => 'SMP'],
            ['service_name' => 'LeMinerale 600ml', 'service_price' => 4000, 'stock' => 25, 'supplier_id' => 'SMP'],
            ['service_name' => 'Golda Coffee', 'service_price' => 4000, 'stock' => 24, 'supplier_id' => 'SMP'],
            ['service_name' => 'Milku', 'service_price' => 4000, 'stock' => 24, 'supplier_id' => 'SMP'],
            ['service_name' => 'Fruit Tea', 'service_price' => 5000, 'stock' => 24, 'supplier_id' => 'SMP'],
            ['service_name' => 'X-Tea', 'service_price' => 1000, 'stock' => 30, 'supplier_id' => 'SMP'],
            ['service_name' => 'Es Kelapa Muda sachet', 'service_price' => 1000, 'stock' => 30, 'supplier_id' => 'SMP'],
            ['service_name' => 'Indodes', 'service_price' => 500, 'stock' => 30, 'supplier_id' => 'SMP'],
            ['service_name' => 'Ale Ale', 'service_price' => 1000, 'stock' => 30, 'supplier_id' => 'SMP'],
            ['service_name' => 'Frestea', 'service_price' => 5000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Kratindaeng', 'service_price' => 8000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Kopiko 78', 'service_price' => 7000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Pocari Botol 550ml', 'service_price' => 7000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Floridina', 'service_price' => 5000, 'stock' => 24, 'supplier_id' => 'SMP'],
            ['service_name' => 'Bombon Karet', 'service_price' => 500, 'stock' => 50, 'supplier_id' => 'SMP'],
            ['service_name' => 'Permen Satuan', 'service_price' => 250, 'stock' => 400, 'supplier_id' => 'SMP'],
            ['service_name' => 'Chitato Lite', 'service_price' => 3000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Superstar', 'service_price' => 1000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Nextar', 'service_price' => 1000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'BearBrand', 'service_price' => 11000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Lasegar Kaleng', 'service_price' => 7000, 'stock' => 16, 'supplier_id' => 'SMP'],
            ['service_name' => 'GoodDay Botol', 'service_price' => 7000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Nescafe Kaleng', 'service_price' => 9000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Indomilk Botol', 'service_price' => 5000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Milo UHT', 'service_price' => 4000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Coca Cola', 'service_price' => 6000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Fanta', 'service_price' => 6000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Cimory Yogurth 125ml', 'service_price' => 4000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Top', 'service_price' => 500, 'stock' => 20, 'supplier_id' => 'SMP'],
            ['service_name' => 'Sari Gandum', 'service_price' => 2000, 'stock' => 20, 'supplier_id' => 'SMP'],
            ['service_name' => 'Piattos', 'service_price' => 3000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Yakult', 'service_price' => 3000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Susu Krimer Sct', 'service_price' => 1500, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Nabati', 'service_price' => 2000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Pepsodent', 'service_price' => 6000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Sedap Cup Goreng', 'service_price' => 6000, 'stock' => 6, 'supplier_id' => 'SMP'],
            ['service_name' => 'Popmie', 'service_price' => 6000, 'stock' => 6, 'supplier_id' => 'SMP'],
            ['service_name' => 'Tori Miso', 'service_price' => 6000, 'stock' => 6, 'supplier_id' => 'SMP'],
            ['service_name' => 'Mie 100 Goreng', 'service_price' => 3000, 'stock' => 3, 'supplier_id' => 'SMP'],
            ['service_name' => 'Indomie Soto Medan', 'service_price' => 3000, 'stock' => 3, 'supplier_id' => 'SMP'],
            ['service_name' => 'Sabun Dettol', 'service_price' => 5000, 'stock' => 3, 'supplier_id' => 'SMP'],
            ['service_name' => 'GG Merah 12', 'service_price' => 16000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'GG Merah 16', 'service_price' => 20000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Sampoerna Mild 12', 'service_price' => 25000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Sampoerna Mild 16', 'service_price' => 35000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Dji Sam Soe', 'service_price' => 20000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Magnum Black', 'service_price' => 24000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Marlboro', 'service_price' => 49000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Dunhill', 'service_price' => 34000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'LA Ice Purple', 'service_price' => 33000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Surya 16', 'service_price' => 35000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Surya 12', 'service_price' => 26000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Chief', 'service_price' => 17000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Sempurna Hijau', 'service_price' => 16000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Mustika', 'service_price' => 12000, 'stock' => 10, 'supplier_id' => 'SMP'],
            ['service_name' => 'Samsu Black', 'service_price' => 21000, 'stock' => 10, 'supplier_id' => 'SMP'],
        ]);
    }
}
