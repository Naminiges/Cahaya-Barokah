<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'Putera', 'phone' => '12123434', 'usertype' => 'admin', 'phone_verified_at' => NULL, 'password' => Hash::make('nami1234'), 'remember_token' => NULL, 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Diva', 'phone' => '34341212', 'usertype' => 'user', 'phone_verified_at' => NULL, 'password' => Hash::make('diva1234'), 'remember_token' => NULL, 'created_at' => NOW(), 'updated_at' => NOW()],
        ]);
    }
}
