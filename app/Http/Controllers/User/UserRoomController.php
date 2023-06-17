<?php

namespace App\Http\Controllers\User;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRoomController extends Controller
{
    public function index()
    {
        return response()->base_response(Room::where("is_active", 1)->get());
    }
}
