<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'admin',
            'username' => 'admin',
            'no_telepon' => '999999999999',
            'role' => 'admin',
            'password' => bcrypt('adminadmin')
        ]);
    }
}
