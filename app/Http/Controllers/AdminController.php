<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Resources\BookingRequestResource;

class AdminController extends Controller
{
    public function bookingRequest () {
        $data = Booking::whereDate("booking_date", Carbon::now("Asia/Makassar"))->get();
        return response()->base_response(BookingRequestResource::collection($data));
    }

    public function approve (Request $request, Booking $booking) {
        $validated = $request->validate([
            "is_approved" => "required|bool",
        ]);
        $booking->update($validated);
        return response()->base_response("", 200, "OK", "Data Berhasil Di Update");
    }
}
