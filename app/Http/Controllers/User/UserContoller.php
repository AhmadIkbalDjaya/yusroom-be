<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserContoller extends Controller
{
    public function changePass(Request $request) {
        $validated = $request->validate([
            "password" => "required|min:8|confirmed",
        ]);
        $validated["password"] = Hash::make($validated["password"]);
        $user = User::find(auth()->user()->id);
        $user->updated($validated);
        return response()->base_response([], 200, "OK", "Password berhasil di ubah");
    }
}
