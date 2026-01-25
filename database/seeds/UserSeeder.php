<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_level' => 1,
            'user_username' => 'admin',
            'user_nama' => 'Administrator',
            'user_email' => 'admin@example.com',
            'user_tlp' => '081234567890',
            'user_unit' => 1,
            'password' => Hash::make('admin123'),
        ]);
        
        echo "Admin user created successfully\n";
    }
}