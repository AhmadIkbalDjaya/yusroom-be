<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Resources\BookingResource;

class BookingController extends Controller
{
    public function store (Request $request) {
      $validated = $request->validate([
        "user_id" => "required|exists:users,id",
        "room_id" => "required|exists:rooms,id",
        "booking_date" => "required|date",
        "start_time" => "required|date_format:H:i:s|before:time_out",
        "end_time" => "required|date_format:H:i:s|after:time_in",
      ]);
      Booking::create($validated);
      return response()->base_response("", 201, "Created", "Booking berhasil ditambahkan, silakah tunggu persetujuan admin");
    }

    public function show (Booking $booking) {
      $booking = new BookingResource($booking);
      return response()->base_response($booking);
    }

    public function update (Request $request, Booking $booking) {
      $validated = $request->validate([
        "room_id" => "required|exists:rooms,id",
        // "booking_date" => "required|date",
        "start_time" => "required|date_format:H:i:s|before:time_out",
        "end_time" => "required|date_format:H:i:s|after:time_in",
      ]);
      $booking->update($validated);
      return response()->base_response("", 200, "OK", "Data Berhasil Di Update");
    }

    public function destroy (Booking $booking) {
      $booking->delete();
      return response()->base_response("", 200, "OK", "Data Berhasil Dihapus");
    }
}
