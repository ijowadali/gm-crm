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
        $getLastBooking = null;
        if (request('booking_no')) {
            $newBooking = Bookings::query()->where('booking_no', request('booking_no'))->first();
        } else {
            $getLastBooking = Bookings::query()->orderBy('id', 'desc')->pluck('booking_no')->first();
            if (!$getLastBooking) {
                $getLastBooking = 1000000000001;
            } else {
                $getLastBooking = (int)$getLastBooking + 1;
            }
            $newBooking = new Bookings();
            $newBooking->booking_no = $getLastBooking;
        }
//        $newBooking->customer_id = request('customer_id');
        $newBooking->customer_name = request('customer_name');
        $newBooking->booking_date = date('Y-m-d', strtotime(request('booking_date')));
        $newBooking->booking_status = request('booking_status');
        $newBooking->group_name = request('group_name');
        $newBooking->group_no = request('group_no');
        $newBooking->category = request('category');
        $newBooking->approval_date = date('Y-m-d', strtotime(request('approval_date')));
        $newBooking->expected_departure = date('Y-m-d', strtotime(request('expected_departure')));
        $newBooking->confirmed_ticket = request('confirmed_ticket') ? 1 : 0;
        $newBooking->save();
        $this->insertBookingVisaDetails($getLastBooking);
        $this->insertBookingHotelDetails($getLastBooking);
        return ['status' => true, 'message' => 'Booking Added Successfully'];

    }

    public function insertBookingVisaDetails($bookingNo)
    {
        if (request('booking_no')) {
            $newBookingVisaDetails = BookingVisaDetails::query()->where('booking_no', request('booking_no'))->first();
        } else {
            $newBookingVisaDetails = new BookingVisaDetails();
            $newBookingVisaDetails->booking_no = $bookingNo;
        }
        $visa = request('visa');
        $newBookingVisaDetails->iata = $visa['iata'];
        $newBookingVisaDetails->visa_company = $visa['visa_company'];
        $newBookingVisaDetails->visa_status = $visa['visa_status'];
        $newBookingVisaDetails->save();
    }

    public function insertBookingHotelDetails($bookingNo)
    {
        if (request('booking_no')) {
            $newBookingHotelDetails = BookingHotelDetails::query()->where('booking_no', request('booking_no'))->first();
        } else {
            $newBookingHotelDetails = new BookingHotelDetails();
            $newBookingHotelDetails->booking_no = $bookingNo;
        }
        $hotel = request('hotel');
        $newBookingHotelDetails->room_type = $hotel['room_type'];
        $newBookingHotelDetails->package = $hotel['package'];
        $newBookingHotelDetails->hotel1_name = $hotel['hotel1_name'];
        $newBookingHotelDetails->nights1 = $hotel['nights1'];
        $newBookingHotelDetails->hotel2_name = $hotel['hotel2_name'];
        $newBookingHotelDetails->nights2 = $hotel['nights2'];
        $newBookingHotelDetails->hotel3_name = $hotel['hotel3_name'];
        $newBookingHotelDetails->nights3 = $hotel['nights3'];
        $newBookingHotelDetails->short_booking = $hotel['short_booking'] ? 1 : 0;
        if ($hotel['short_booking']) {
            $newBookingHotelDetails->adults = $hotel['adults'];
            $newBookingHotelDetails->childs = $hotel['childs'];
            $newBookingHotelDetails->infants = $hotel['infants'];
        }
        $newBookingHotelDetails->save();
    }

    public function getBookingData($id)
    {
        $data = Bookings::query()->where('id', $id)
            ->with(['visa', 'hotel'])->first();
        if (!$data) {
            return ['status' => false, 'message' => 'Booking Not Found'];
        }
        return ['status' => true, 'data' => $data];
    }

    public function delete($id)
    {
        $data = Bookings::query()->find($id);
        if (!$data) {
            return ['status' => false, 'message' => 'Booking Not Found'];
        }
        $data->delete();
        return ['status' => true, 'message' => 'Deleted Successfully'];
    }
}
