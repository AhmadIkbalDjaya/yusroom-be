<?php

namespace App\Http\Controllers\User;

use App\Models\Room;
use App\Models\Time;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use Carbon\Carbon;
use PhpParser\Node\Expr\Cast\Bool_;

class UserBookingController extends Controller
{
    public function index(Room $room)
    {
        $room->image = url("storage/$room->image");
        $times = Time::orderBy("start_time")->get();

        $timeData = $times->map(function ($time) use ($room) {
            $booking = Booking::where("booking_date", Carbon::now()->format("Y-m-d"))
                ->where("room_id", $room->id)
                ->where("start_time", $time->start_time)
                ->where("end_time", $time->end_time)
                ->exists();

            $time->is_booking = $booking;
            $time->start_time = Carbon::parse($time->start_time)->format("H:i");
            $time->end_time = Carbon::parse($time->end_time)->format("H:i");
            return $time;
        });
        $data = [
            "room" => $room,
            "times" => $timeData,
            "confirmedBookings" => Booking::where("booking_date", Carbon::now()->format("Y-m-d"))
                ->where("room_id", $room->id)
                ->get()
        ];
        return response()->base_response($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "room_id" => "required|exists:rooms,id",
            "start_time" => "required",
            "end_time" => "required",
            "description" => "required|string",
        ]);
        $validated["user_id"] = auth()->user()->id;
        $validated["booking_date"] = Carbon::now()->format("Y-m-d");
        try {
            Booking::create($validated);
            return response()->base_response([], 201, "Created", "Booking berhasil ditambahkan");
        } catch (\Throwable $th) {
            return response()->base_response([
                "message" => $th->getMessage(),
            ], 500, "Internal Server Error", "Terjadi kesalahan internal server");
        }
    }

    public function myBooking()
    {
        $data = Booking::where("user_id", auth()->user()->id)->latest()->get();
        return response()->base_response(BookingResource::collection($data));
    }

    public function destroy(Booking $booking)
    {
        if ($booking->is_approved == 1) {
            return response()->base_response([], 400, "Bad Request", "Booking yang telah disetujui tidak dapat dihapus");
        }
        try {
            $booking->delete();
            return response()->base_response([], 200, "OK", "Data berhasil dihapus");
        } catch (\Throwable $th) {
            return response()->base_response([
                "message" => $th->getMessage(),
            ], 500, "Internal Server Error", "Terjadi kesalahan internal server");
        }
    }
}
