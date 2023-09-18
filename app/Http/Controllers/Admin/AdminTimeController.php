<?php

namespace App\Http\Controllers\Admin;

use App\Models\Time;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTimeController extends Controller
{
    public function index()
    {
        return response()->base_response(Time::select('id','start_time','end_time')->orderBy('start_time')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "start_time" => "required",
            "end_time" => "required|after:start_time",
        ]);
        try {
            $time = Time::create($validated);
            return response()->base_response($time, 201, "Created", "Data berhasil ditambahkan");
        } catch (\Throwable $th) {
            return response()->base_response([
                "message" => $th->getMessage(),
            ], 500, "Internal Server Error", "Terjadi kesalahan internal server");
        }
    }
    
    public function show(Time $time)
    {
        return response()->base_response($time);
    }
    
    public function update(Request $request, Time $time)
    {
        $validated = $request->validate([
            "start_time" => "required",
            "end_time" => "required|after:start_time",
        ]);
        try {
            $time->update($validated);
            return response()->base_response($time, 200, "OK", "Data berhasil diedit");
        } catch (\Throwable $th) {
            return response()->base_response([
                "message" => $th->getMessage(),
            ], 500, "Internal Server Error", "Terjadi kesalahan internal server");
        }
    }
    
    public function destroy(Time $time)
    {
        try {
            $time->delete();
            return response()->base_response([], 200, "OK", "Data berhasil dihapus");
        } catch (\Throwable $th) {
            return response()->base_response([
                "message" => $th->getMessage(),
            ], 500, "Internal Server Error", "Terjadi kesalahan internal server");
        }
    }
}
