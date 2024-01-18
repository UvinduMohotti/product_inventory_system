<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users =[
            [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin1234'),
            'role' => 'admin',
            ],
            [
                'name' => 'Uvindu Mohotti',
                'email' => 'uvindu98@gmail.com',
                'password' => bcrypt('ABC123'),
                'role' => 'user',
            ]
        ];
        DB::table('users')->insert($users);

    }
}
