<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
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
        User::create([
            'name'      => 'test',
            'email'     => 'test@mail.com',
            'password'  => Hash::make('123123123'),
            'email_verified_at' => Date::now(),
        ]);
    }
}
