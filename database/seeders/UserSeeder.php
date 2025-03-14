<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { User::create([
        'name' => 'أحمد',
        'email' => 'ahmad@example.com',
        'password' => Hash::make('password123'), // تأكد من إضافة كلمة مرور
    ]);
        
    }
}