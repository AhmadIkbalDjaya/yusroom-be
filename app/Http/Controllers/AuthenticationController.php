<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('username', $request->username)->where("is_admin", 0)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->base_response('', 401, "Unauthorized", "Incorrect nik or password");
        }
        $data = [
            "access_token" => $user->createToken('token')->plainTextToken,
            "user_id" => $user->id,
            "name" => $user->name,
            "username" => $user->username,
        ];
        return response()->base_response($data, 200, "OK", "Login Success");
    }

    public function adminLogin(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('username', $request->username)->where("is_admin", 1)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->base_response('', 401, "Unauthorized", "Incorrect nik or password");
        }
        $data = [
            "access_token" => $user->createToken('token')->plainTextToken,
            "user_id" => $user->id,
            "name" => $user->name,
            "username" => $user->username,
        ];
        return response()->base_response($data, 200, "OK", "Login Success");
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->base_response('', 200, "OK", "Logout Success");
    }
}
