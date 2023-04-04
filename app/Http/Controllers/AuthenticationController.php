<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login (Request $request) {
        $request->validate([
            'nik' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('nik', $request->nik)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->base_response('', 401, "Unauthorized", "Incorrect nik or password");
        }
        $data['access_token'] = $user->createToken('admin_token')->plainTextToken;
        $data["user_id"] = $user->id;
        return response()->base_response($data, 200, "OK", "Login Success");
        // return $user->createToken('user login')->plainTextToken;
    }

    public function logout (Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->base_response('', 200, "OK", "Logout Success");
    }

}
