<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index () {
        return response()->base_response(Room::where("is_active", true)->select("id", "name", "capacity", "description")->get());
    }
    
    public function show (Room $room) {
        return response()->base_response($room->only(["id", "name", "capacity", "description"]));
    }
}
