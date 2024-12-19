<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email'=>'guest@gmail.com',
            'role'=>'GUEST',
            'password' => Hash::make('guest123')
        ]);

        User::create([
            'email'=>'headstaff@gmail.com',
            'role'=>'HEAD_STAFF',
            'password' => Hash::make('headstaff123')
        ]);

        User::Create([
            'email'=>'staff@gmail.com',
            'role'=>'STAFF',
            'password' => Hash::make('staff123')
        ]);
    }
}
