<?php

namespace Database\Seeders;

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
            'name' => "Super Admin",
            'email' => "super@hydrofam.co",
            'password' => Hash::make('super123'),
            'gender' => 1,
            'phone_number' => '0812345677',
            'birth_date' => '2000-07-05',
            'province' => 'Jawa Timur',
            'city' => 'Jember',
            'sub_district' => 'Sumbersari',
            'postal_code' => '67875',
            'detail' => 'Jalan Jawa 2C'
        ]);

        DB::table('user_role')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);

        DB::table('canvas_users')->insert([
            "id" => 1,
            "name" => "Super",
            "email" => "super@hydrofam.co",
            "username" => "Super",
            "password" => Hash::make('super123')
        ]);

        DB::table('users')->insert([
            'name' => "Admin",
            'email' => "admin@hydrofam.co",
            'password' => Hash::make('admin123'),
            'gender' => 1,
            'phone_number' => '0812345677',
            'birth_date' => '2000-07-05',
            'province' => 'Jawa Timur',
            'city' => 'Jember',
            'sub_district' => 'Sumbersari',
            'postal_code' => '67875',
            'detail' => 'Jalan Jawa 2C'
        ]);

        DB::table('user_role')->insert([
            'user_id' => 2,
            'role_id' => 2
        ]);

        DB::table('canvas_users')->insert([
            "id" => 2,
            "name" => "Admin",
            "email" => "admin@hydrofam.co",
            "username" => "Admin",
            "password" => Hash::make('admin123')
        ]);

        DB::table('users')->insert([
            'name' => "Member",
            'email' => "member@hydrofam.co",
            'password' => Hash::make('member123'),
            'gender' => 1,
            'phone_number' => '0812345677',
            'birth_date' => '2000-07-05',
            'province' => 'Jawa Timur',
            'city' => 'Jember',
            'sub_district' => 'Sumbersari',
            'postal_code' => '67875',
            'detail' => 'Jalan Jawa 2C'
        ]);

        DB::table('user_role')->insert([
            'user_id' => 3,
            'role_id' => 3
        ]);
    }
}
