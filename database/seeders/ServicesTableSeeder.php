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
            ['supplier_id' => 'RKA', 'name' => 'Sempurna', 'contact_name' => 'Supplier Sempurna', 'phone' => '082362737878', 'address' => 'Jl.Wahidin No.15'],
            ['supplier_id' => 'SMP', 'name' => 'Rezeki Kencana Abadi', 'contact_name' => 'Gas Rezeki', 'phone' => '', 'address' => ''],
        ]);

        DB::table('services')->insert([
            ['service_name' => 'Gas Elpiji 3kg', 'service_price' => 17000, 'stock' => 300, 'supplier_id' => 'RKA'],
            ['service_name' => 'Aqua Galon 19l', 'service_price' => 22000, 'stock' => 12, 'supplier_id' => 'SMP'],
            ['service_name' => 'Beras Lemon 5kg', 'service_price' => 63000, 'stock' => 12, 'supplier_id' => 'SMP'],
        ]);
    }
}
