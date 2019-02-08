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
            $table->integer('group_id')->unsigned();//owner
            $table->integer('user_id')->unsigned()->nullable();//user gun is assigned to
            $table->string('serial_code');
            $table->string('model')->nullable();
            $table->string('type')->nullable();
            $table->float('lat')->unsigned()->nullable();
            $table->float('long')->unsigned()->nullable();
            $table->float('geo_radius')->unsigned()->default(0);
            $table->integer('emergency_allow')->unsigned()->default(0);
            $table->integer('emergency_duration')->unsigned()->default(0);
            $table->string('emergency_duration_unit')->default('hour');
            $table->string('rfid', 2500)->nullable();//authorisation
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
