<?php

namespace App\Http\Controllers\Admin;

use App\Models\Time;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->base_response(Time::orderBy('start_time')->get());
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
            "start_time" => "required",
            "end_time" => "required|after:start_time",
        ]);
        Time::create($validated);
        return response()->base_response([], 201, "Created", "Data berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Time $time)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Time $time)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Time $time)
    {
        $validated = $request->validate([
            "start_time" => "required",
            "end_time" => "required|after:start_time",
        ]);
        $time->update($validated);
        return response()->base_response([], 200, "OK", "Data berhasil diedit");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Time $time)
    {
        $time->delete();
        return response()->base_response([], 200, "OK", "Data berhasil dihapus");
    }
}
