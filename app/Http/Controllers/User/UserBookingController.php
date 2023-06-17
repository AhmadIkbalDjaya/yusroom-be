<?php

namespace App\Http\Controllers\User;

use App\Models\Room;
use App\Models\Time;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PhpParser\Node\Expr\Cast\Bool_;

class UserBookingController extends Controller
{
    public function index(Room $room)
    {
        $data = [
            "room" => $room,
            "times" => Time::orderBy("start_time")->get(),
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
        $validated["user_id"] = "1";
        $validated["booking_date"] = Carbon::now()->format("Y-m-d");
        Booking::create($validated);
        return response()->base_response([], 201, "Created", "Booking berhasil ditambahkan");
    }

    public function myBooking()
    {
        $data = Booking::where("user_id", 1)->latest()->get();
        return response()->base_response($data);
    }

    public function destroy(Booking $booking)
    {
        if ($booking->is_approved == 1 || $booking->is_approved == 0) {
            return response()->base_response([], 404, "Not Ok", "Booking yang telah disetujui tidak dapat dihapus");
        }
        $booking->delete();
        return response()->base_response([], 200, "OK", "Data berhasil dihapus");
    }
}
