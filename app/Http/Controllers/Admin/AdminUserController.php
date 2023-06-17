<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->base_response(User::where("is_admin", 0)->get());
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
            "username" => "required|string|alpha_dash|min:3|unique:users,username",
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8",
        ]);
        $validated["password"] = Hash::make($validated["password"]);
        User::create($validated);
        return response()->base_response([], 201, "Created", "Data berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->base_response($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            "username" => "required|string|alpha_dash|min:3|unique:users,username,$user->id",
            "name" => "required|string",
            "email" => "required|email|unique:users,email,$user->id",
            "password" => "nullable|min:8",
        ]);
        if ($request->password) {
            $validated["password"] = Hash::make($validated["password"]);
        }
        $user->update($validated);
        return response()->base_response([], 200, "OK", "Data berhasil diedit");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->base_response([], 200, "OK", "Data berhasil dihapus");
    }
}
