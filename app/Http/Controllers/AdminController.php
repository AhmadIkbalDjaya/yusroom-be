<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function bookingRequest () {
        return response()->base_response("ok");
    }
}
