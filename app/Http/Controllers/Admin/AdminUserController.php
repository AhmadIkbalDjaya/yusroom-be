<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        return response()->base_response(User::where("is_admin", 0)->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "username" => "required|string|alpha_dash|min:3|unique:users,username",
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8",
        ]);
        $validated["password"] = Hash::make($validated["password"]);
        try {
            $user = User::create($validated);
            return response()->base_response($user, 201, "Created", "Data berhasil ditambahkan");
        } catch (\Throwable $th) {
            return response()->base_response([
                "message" => $th->getMessage(),
            ], 500, "Internal Server Error", "Terjadi kesalahan internal server");
        }
    }

    public function show(User $user)
    {
        return response()->base_response($user);
    }

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
        try {
            $user->update($validated);
            return response()->base_response($user, 200, "OK", "Data berhasil diedit");
        } catch (\Throwable $th) {
            return response()->base_response([
                "message" => $th->getMessage(),
            ], 500, "Internal Server Error", "Terjadi kesalahan internal server");
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->base_response([], 200, "OK", "Data berhasil dihapus");
        } catch (\Throwable $th) {
            return response()->base_response([
                "message" => $th->getMessage(),
            ], 500, "Internal Server Error", "Terjadi kesalahan internal server");
        }
    }
}
