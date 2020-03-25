<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'office',
            'email' => 'office@gmail.com',
            'user_type' => 'office',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'production',
            'email' => 'production@gmail.com',
            'user_type' => 'production',
            'password' => Hash::make('password'),
        ]);
    }
}
