<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        error_log($request);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            $user = Auth::user();

            error_log($user);

            $token = $user->createToken('JWT');

            $response = [
                "token" => $token->plainTextToken,
                "id" => $user->id
            ];

            return response()->json($response, 200);
        }

        $lastAttempt = Auth::getLastAttempted();

        $error_message = '';

        if($lastAttempt['email'] != $request->email){
            $error_message = 'Email incorreto';
        }

        if($lastAttempt['password'] != $request->password){
            $error_message = 'Senha incorreta';
        }

        return response()->json($error_message, 401);
    }
}
