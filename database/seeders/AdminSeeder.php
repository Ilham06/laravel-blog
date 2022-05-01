<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin123'),
            ],
            [
                'name' => 'Ilham Muhamad S',
                'email' => 'ilham@mail.com',
                'password' => Hash::make('ilham123'),
            ]
        ];

        User::insert($user);
    }
}
