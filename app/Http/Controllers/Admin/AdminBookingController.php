<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;

class AdminBookingController extends Controller
{
    public function bookingRequest()
    {
        $data = Booking::whereDate('booking_date', Carbon::now("Asia/Makassar"))->latest()->get();
        return response()->base_response(BookingResource::collection($data));
    }

    public function approve(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            "is_approved" => "required|boolean",
        ]);
        $booking->update($validated);
        return response()->base_response([], 200, "OK", "Status booking berhasil diperbaharui");
    }
}
