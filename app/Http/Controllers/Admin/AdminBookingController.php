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
        $data = Booking::whereDate('booking_date', Carbon::now())->latest()->get();
        return response()->base_response(BookingResource::collection($data));
    }

    public function approve(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            "is_approved" => "required|boolean",
        ]);
        if ($request->is_approved == '1') {
            $hasBooking = Booking::where('booking_date', Carbon::now()->isoFormat("Y-M-D"))
                                ->where("start_time", $booking->start_time)
                                ->where("end_time", $booking->end_time)
                                ->where("is_approved", "1")
                                ->where("id", "!=", $booking->id)
                                ->count();
            if ($hasBooking > 0) {
                return response()->base_response([], 400, "Bad Request", "Ruangan Sudah di booking untuk jadwal yang sama");
            }
        }
        try {
            $booking->update($validated);
            return response()->base_response([], 200, "OK", "Status booking berhasil diperbaharui");
        } catch (\Throwable $th) {
            return response()->base_response([
                "message" => $th->getMessage(),
            ], 500, "Internal Server Error", "Terjadi kesalahan internal server");
        }
    }
}
