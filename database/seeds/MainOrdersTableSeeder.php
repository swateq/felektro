<?php

use Illuminate\Database\Seeder;
use App\MainOrder;

class MainOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(MainOrder::class, 20)->create();
    }
}
