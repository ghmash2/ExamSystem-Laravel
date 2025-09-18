<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        // return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device' => ['required']
        ]);
        $user = User::where('email', $credentials['email'])->first();
        if(!$user || ! Hash::check($credentials['password'], $user->password))
        {
            return ApiResponseClass::sendResponse([], 'Email or Password is Invalid', 404);
        }
        $token = $user->createToken($credentials['device'])->plainTextToken;
        $data=[
            'user' => $user,
            'token' => $token
        ];
        return ApiResponseClass::sendResponse($data, 'Successfully Logged in', 200);
        //if (Auth::attempt($credentials, $request->remember))
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ApiResponseClass::sendResponse([], 'Successfully Logged out', 200);
    }
    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();
        return ApiResponseClass::sendResponse([], 'Successfully Logged out from all device', 200);
    }


    public function register()
    {
        // return view('users.create');
    }
}
