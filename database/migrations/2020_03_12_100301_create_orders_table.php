<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('main_order_id');
            $table->integer('dok_id');
            $table->dateTime('accepted_date')->nullable();
            $table->string('subiekt_number');
            $table->string('symbol');
            $table->string('name');
            $table->string('product_id');
            $table->string('client');
            $table->string('status')->default('nowe');
            $table->integer('product_type');
            $table->integer('quantity');
            $table->integer('in_production_quantity')->default(0);
            $table->integer('done_quantity')->default(0);
            $table->boolean('archive')->default(0);
            $table->boolean('accepted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
