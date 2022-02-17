<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => "John Doe",
            'nickname' => "test123",
            'phone' => '89998887766',
            'email' => 'johndoe@gmail.com',
            'phone_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'status' => User::STATUS_ACTIVE
        ]);
        $user->cart()->create();
    }
}
