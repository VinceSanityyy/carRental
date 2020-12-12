<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReservationDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reservation_id')->unsigned();
            $table->string('locationFrom');
            $table->string('locationTo');
            $table->string('dateFrom');
            $table->string('dateTo');
            $table->string('totalDays');
            $table->string('totalDistance');
            $table->string('estimatedDuration');
            $table->timestamps();
        });

        Schema::table('reservation_details', function (Blueprint $table) {
            $table->foreign('reservation_id')->references('id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
