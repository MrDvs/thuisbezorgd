<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpeningtimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('openingtimes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');
            $table->time('open');
            $table->time('close');
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
        Schema::dropIfExists('openingtimes');
    }
}
