<?php

namespace App\Http\Controllers\Api\Bookings;

use App\Http\Controllers\Controller;
use App\Models\BookingHotelDetails;
use App\Models\Bookings;
use App\Models\BookingVisaDetails;

class BookingsController extends Controller
{
    public function index()
    {
        return Bookings::query()
            ->when(request('bookingNo'), function ($q) {
                $q->where('booking_no', request('bookingNo'));
            })
            ->when(request('status'), function ($q) {
                $q->where('booking_status', request('status'));
            })
            ->when(request('date'), function ($q) {
                $q->whereBetween('booking_date', [date('Y-m-d', strtotime(request('date')[0])), date('Y-m-d 23:59:59', strtotime(request('date')[1]))]);
            })
            ->when(request('sortDirection'), function ($q) {
                $q->orderBy(request('sortColumn'), request('sortDirection'));
            })->paginate(request('limit', 20));
    }

    public function create()
    {
        $getLastBooking = Bookings::query()->orderBy('id', 'desc')->pluck('booking_no')->first();
        if (!$getLastBooking) {
            $getLastBooking = 1000000000001;
        } else {
            $getLastBooking = (int)$getLastBooking + 1;
        }
        $newBooking = new Bookings();
        $newBooking->booking_no = $getLastBooking;
//        $newBooking->customer_id = request('customer_id');
        $newBooking->customer_name = request('customer');
        $newBooking->booking_date = date('Y-m-d', strtotime(request('bookingDate')));
        $newBooking->booking_status = request('bookingStatus');
        $newBooking->group_name = request('groupName');
        $newBooking->group_no = request('groupNumber');
        $newBooking->category = request('category');
        $newBooking->approval_date = date('Y-m-d', strtotime(request('approvalDate')));
        $newBooking->expected_departure = date('Y-m-d', strtotime(request('expectedDeparture')));
        $newBooking->confirmed_ticket = request('confirmedTicket') ? 1 : 0;
        $newBooking->save();
        $this->insertBookingVisaDetails($getLastBooking);
        $this->insertBookingHotelDetails($getLastBooking);
        return ['status' => true, 'message' => 'Booking Added Successfully'];

    }

    public function insertBookingVisaDetails($bookingNo)
    {
        $newBookingVisaDetails = new BookingVisaDetails();
        $newBookingVisaDetails->booking_no = $bookingNo;
        $newBookingVisaDetails->iata = request('iata');
        $newBookingVisaDetails->visa_company = request('visaCompany');
        $newBookingVisaDetails->visa_status = request('visaStatus');
        $newBookingVisaDetails->save();
    }

    public function insertBookingHotelDetails($bookingNo)
    {
        $newBookingHotelDetails = new BookingHotelDetails();
        $newBookingHotelDetails->booking_no = $bookingNo;
        $newBookingHotelDetails->room_type = request('roomType');
        $newBookingHotelDetails->package = request('package');
        $newBookingHotelDetails->hotel1_name = request('hotel1');
        $newBookingHotelDetails->nights1 = request('nights1');
        $newBookingHotelDetails->hotel2_name = request('hotel2');
        $newBookingHotelDetails->nights2 = request('nights2');
        $newBookingHotelDetails->hotel3_name = request('hotel3');
        $newBookingHotelDetails->nights3 = request('nights3');
        $newBookingHotelDetails->short_booking = request('shortBooking') ? 1 : 0;
        if (request('shortBooking')) {
            $newBookingHotelDetails->adults = request('adults');
            $newBookingHotelDetails->childs = request('childs');
            $newBookingHotelDetails->infants = request('infants');
        }
        $newBookingHotelDetails->save();
    }
}
