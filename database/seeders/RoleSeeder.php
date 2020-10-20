<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => "super",
            'title' => "Super Admin",
        ]);
        DB::table('roles')->insert([
            'name' => "admin",
            'title' => "Admin",
        ]);
        DB::table('roles')->insert([
            'name' => "user",
            'title' => "User",
        ]);
    }
}
