<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LogoutController extends Controller
{
    public function logout( Request $request ){
        Auth::guard('web')->logout();

        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
