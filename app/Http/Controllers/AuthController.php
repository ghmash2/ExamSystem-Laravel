<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use Auth;
use Exception;
use Illuminate\Http\Request;

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
        ]);
        try {
            if (Auth::attempt($credentials, $request->remember)) {
                // $request->session()->regenerate();
                // return redirect()->intended('/');
                return ApiResponseClass::sendResponse([], 'Successfully Logged in');
            }
            else{
                return ApiResponseClass::sendResponse([], 'Email or Password is Invalid', 404, );
            }
        } catch (Exception $e) {

            return ApiResponseClass::sendResponse([], 'Server Error', 500, $e->getMessage());

        }
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

       return ApiResponseClass::sendResponse([], 'Successfully Logged out',200);
    }

    public function register()
    {
        // return view('users.create');
    }
}
