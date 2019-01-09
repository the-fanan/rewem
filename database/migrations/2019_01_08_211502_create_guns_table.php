<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->float('lat')->unsigned()->nullable();
            $table->float('long')->unsigned()->nullable();
            $table->integer('emergency_allow')->unsigned()->default(1);
            $table->integer('emergency_duration')->unsigned()->default(12);
            $table->string('emergency_duration_unit')->default('hour');
            $table->string('rfid', 2500)->nullable();
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
        Schema::dropIfExists('guns');
    }
}
