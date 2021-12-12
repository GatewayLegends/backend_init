<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email|max:150',
            'password' => 'required|min:8|max:64',
        ]);

        $remember = $request->validate([
            'remember' => 'required|boolean',
        ])['remember'];

        if (Auth::attempt($credentials, $remember)) {

            return response([
                'user' => Auth::user(),
            ], 200);
        }

        return response([
            'message' => 'wrong email or password'
        ], 422);

    }

    public function logout()
    {
        Auth::logout();

        return response([], 204);
    }
}
