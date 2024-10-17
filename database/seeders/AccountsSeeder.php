<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Pond Guard',
            'email' => 'pondguard@gmail.com',
            'mobile_no' => '+639654865436',
            'password' => Hash::make('pondguard@2024'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Normal User',
            'email' => 'normal@normal.com',
            'mobile_no' => '+639964664378',
            'password' => Hash::make('normal@2024'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Third User',
            'email' => 'third@third.com',
            'mobile_no' => '+6398766543657',
            'password' => Hash::make('third@2024'),
            'role' => 'user',
        ]);
    }
}
