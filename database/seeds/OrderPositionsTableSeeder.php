<?php

use App\OrderPosition;
use Illuminate\Database\Seeder;

class OrderPositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OrderPosition::class, 200)->create();
    }
}
