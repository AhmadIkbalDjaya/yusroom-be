<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Room::latest()->get();
        $modifiedData = $data->map(function ($room) {
            $room->image = url("storage/$room->image");
            return $room;
        });
        return response()->base_response($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "image" => "nullable|image",
            "description" => "nullable|string",
            "is_active" => "boolean",
        ]);
        if ($request->image) {
            $validated["image"] = $request->file("image")->store("rooms");
        }
        Room::create($validated);
        return response()->base_response([], 201, "Created", "Data berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $room->image = url("storage/$room->image");
        return response()->base_response($room);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "image" => "nullable|image",
            "description" => "nullable|string",
            "is_active" => "boolean",
        ]);
        if ($request->image) {
            if ($room->image != "rooms/default.jpg") {
                Storage::delete($room->image);
            }
            $validated["image"] = $request->file("image")->store("rooms");
        }
        $room->update($validated);
        return response()->base_response([], 200, "OK", "Data berhasil diedit");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        if ($room->image != "rooms/default.jpg") {
            Storage::delete($room->image);
        }
        $room->delete();
        return response()->base_response([], 200, "OK", "Data berhasil dihapus");
    }
}
