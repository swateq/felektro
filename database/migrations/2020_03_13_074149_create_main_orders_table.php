<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_orders', function (Blueprint $table) {
            $table->id();
            $table->datetime('date');
            $table->integer('dok_id');
            $table->string('subiekt_number');
            $table->string('client');
            $table->string('client_type');
            $table->string('status');
            $table->integer('quantity');
            $table->integer('done_quantity');
            $table->boolean('archive')->default(0);
            $table->boolean('accepted')->default(0);
            $table->datetime('accepted_date')->nullable();
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
        Schema::dropIfExists('main_orders');
    }
}
