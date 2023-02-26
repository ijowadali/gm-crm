<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingHotelDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_hotel_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_no');
            $table->foreign('booking_no')->references('booking_no')->on('bookings')->onDelete('cascade');
            $table->string('room_type');
            $table->string('package');
//            $table->boolean('short_booking')->default(0);
            $table->unsignedBigInteger('hotel1_id')->nullable();
            $table->string('hotel1_name')->nullable();
            $table->integer('nights1')->nullable();
            $table->unsignedBigInteger('hotel2_id')->nullable();
            $table->string('hotel2_name')->nullable();
            $table->integer('nights2')->nullable();
            $table->unsignedBigInteger('hotel3_id')->nullable();
            $table->string('hotel3_name')->nullable();
            $table->integer('nights3')->nullable();
            $table->boolean('short_booking')->default(0);
            $table->integer('adults')->nullable();
            $table->integer('childs')->nullable();
            $table->integer('infants')->nullable();
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
        Schema::dropIfExists('booking_hotel_details');
    }
}
