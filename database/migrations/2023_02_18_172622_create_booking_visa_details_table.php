<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingVisaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_visa_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_no');
            $table->foreign('booking_no')->references('booking_no')->on('bookings')->onDelete('cascade');
            $table->string('iata')->nullable();
            $table->string('visa_company')->nullable();
            $table->string('visa_status');
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
        Schema::dropIfExists('visa_details');
    }
}
