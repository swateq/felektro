<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('workers')->insert([
            'name' => 'Krzysiek',
        ]);
        DB::table('workers')->insert([
            'name' => 'Adam',
        ]);
        DB::table('workers')->insert([
            'name' => 'Piotrek',
        ]);
        DB::table('workers')->insert([
            'name' => 'Marek',
        ]);
    }
}
