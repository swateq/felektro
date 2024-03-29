<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(WorkersTableSeeder::class);
        //$this->call(OrdersTableSeeder::class);
        //$this->call(MainOrdersTableSeeder::class);
        //$this->call(OrderPositionsTableSeeder::class);
    }
}
