<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'test',
            'nickname' => 'test',
            'email' => 'test@mail.com',
            'phone' => 'test',
            'password' => Hash::make('123123123'),
            'role' => 'super-admin',
        ]);
    }
}
