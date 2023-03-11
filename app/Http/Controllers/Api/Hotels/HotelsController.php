<?php

namespace App\Http\Controllers\Api\Hotels;

use App\Http\Controllers\Controller;
use App\Models\Hotel;

class HotelsController extends Controller
{
    public function index()
    {
        return Hotel::query()
            ->when(request('hotel_name'), function ($q) {
                $q->where('hotel_name', request('hotel_name'));
            })
            ->when(request('city'), function ($q) {
                $q->where('city', 'Like', '%' . request('city') . '%');
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
        if (request('id')) {
            $newHotel = Hotel::query()->find(request('id'));
        } else {
            $check_hotel = Hotel::query()->where('hotel_name', request('hotel_name'))->where('city', request('city'))->first();
            if ($check_hotel) {
                return ['status' => false, 'message' => 'Hotel Already Exist'];
            }
            $newHotel = new Hotel();
        }
        $newHotel->hotel_name = request('hotel_name');
        $newHotel->city = request('city');
        $newHotel->primary_phone = request('primary_phone');
        $newHotel->secondary_phone = request('secondary_phone');
        $newHotel->address = request('address');
        $newHotel->save();
        return ['status' => true, 'message' => 'Operation Successfully'];

    }

    public function getHotelData($id)
    {
        $data = Hotel::query()->where('id', $id)->first();
        if (!$data) {
            return ['status' => false, 'message' => 'Hotel Not Found'];
        }
        return ['status' => true, 'data' => $data];
    }

    public function delete($id)
    {
        $data = Hotel::query()->find($id);
        if (!$data) {
            return ['status' => false, 'message' => 'Hotel Not Found'];
        }
        $data->delete();
        return ['status' => true, 'message' => 'Deleted Successfully'];
    }
}
