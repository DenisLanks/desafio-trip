<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Trips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('trips')) {
            Schema::create('trips', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('from')->unsigned();
                $table->bigInteger('to')->unsigned();
                $table->integer('user')->unsigned();
                $table->decimal('distance', 8, 2);
                $table->double('price', 15, 8);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
