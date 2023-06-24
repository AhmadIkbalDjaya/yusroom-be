<?php

namespace App\Http\Controllers\User;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRoomController extends Controller
{
    public function index()
    {
        $data = Room::where("is_active", 1)->get();
        $modifiedData = $data->map(function ($room) {
            $room->image = url("storage/$room->image");
            return $room;
        });
        return response()->base_response($data);
    }
}
