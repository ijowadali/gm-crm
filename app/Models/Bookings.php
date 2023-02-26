<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bookings extends Model
{

    public function visa(): HasOne
    {
        return $this->hasOne(BookingVisaDetails::class, 'booking_no', 'booking_no');
    }

    public function hotel(): HasOne
    {
        return $this->hasOne(BookingHotelDetails::class, 'booking_no', 'booking_no');
    }
}
