<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminRoomController extends Controller
{
    public function index()
    {
        $data = Room::latest()->get();
        $data->map(function ($room) {
            $room->image = url("storage/$room->image");
            return $room;
        });
        return response()->base_response($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "image" => "nullable|image",
            "description" => "nullable|string",
            "is_active" => "boolean",
        ]);
        if ($request->image) {
            $validated["image"] = $request->file("image")->storePublicly("rooms", "public");
        }
        try {
            $room = Room::create($validated);
            return response()->base_response($room, 201, "Created", "Data berhasil ditambahkan");
        } catch (\Throwable $th) {
            return response()->base_response([
                "message" => $th->getMessage(),
            ], 500, "Internal Server Error", "Terjadi kesalahan internal server");
        }
    }

    public function show(Room $room)
    {
        $room->image = url("storage/$room->image");
        return response()->base_response($room);
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "image" => "nullable|image",
            "description" => "nullable|string",
            "is_active" => "boolean",
        ]);
        if ($request->image) {
            if ($room->image != "rooms/default.jpg" && Storage::exists($room->image)) {
                Storage::delete($room->image);
            }
            $validated["image"] = $request->file("image")->storePublicly("rooms", "public");
        } else {
            unset($validated["image"]);
        }
        try {
            $room->update($validated);
            return response()->base_response($room, 200, "OK", "Data berhasil diedit");
        } catch (\Throwable $th) {
            return response()->base_response([
                "message" => $th->getMessage(),
            ], 500, "Internal Server Error", "Terjadi kesalahan internal server");
        }
    }

    public function destroy(Room $room)
    {
        try {
            if ($room->image != "rooms/default.jpg" && Storage::exists($room->image)) {
                Storage::delete($room->image);
            }
            $room->delete();
            return response()->base_response([], 200, "OK", "Data berhasil dihapus");
        } catch (\Throwable $th) {
            return response()->base_response([
                "message" => $th->getMessage(),
            ], 500, "Internal Server Error", "Terjadi kesalahan internal server");
        }
    }
}
