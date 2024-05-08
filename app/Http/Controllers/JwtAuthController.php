<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Tymon\JWTAuth\Facades\JWTAuth;


class JwtAuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required"
        ]);

        User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return response()->json([
            "status" => true,
            "message" => "User registered successfully"
        ]);
    }

    public function login(Request $request){
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $csrfLength = env("CSRF_TOKEN_LENGTH");
        $csrfToken = Random::generate($csrfLength);

        $token = JWTAuth::claims(['X-XSRF-TOKEN' => $csrfToken])->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if(empty($token)){
            return response()
                ->json([
                    "status" => false,
                    "message" => "Invalid details"
                ]);
        }

        $ttl = env("JWT_COOKIE_TTL");
        $tokenCookie = cookie("token", $token, $ttl);
        $csrfCookie = cookie("X-XSRF-TOKEN", $csrfToken, $ttl);

        return response([
            "status" => true,
            "message" => "User logged in succcessfully"
        ])
            ->withCookie($tokenCookie)
            ->withCookie($csrfCookie);
    }

    public function profile(){
        $userdata = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userdata
        ]);
    }

    public function isLoggedIn(){
        return response()->json([
            "status" => true,
        ]);
    }

    public function isAdmin(Request $request){
        return response()->json([
            "status" => true,
        ]);
    }

    public function refreshToken(){
        $csrfLength = env("CSRF_TOKEN_LENGTH");
        $csrfToken = Random::generate($csrfLength);

        $token = JWTAuth::claims(['X-XSRF-TOKEN' => $csrfToken])->refresh();

        $ttl = env("JWT_COOKIE_TTL");
        $tokenCookie = cookie("token", $token, $ttl);
        $csrfCookie = cookie("X-XSRF-TOKEN", $csrfToken, $ttl);

        return response(["message" => "Token refresh succcessfully"])
            ->withCookie($tokenCookie)
            ->withCookie($csrfCookie);
    }

    public function logout(){
        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "User logged out successfully"
        ]);
    }
}

