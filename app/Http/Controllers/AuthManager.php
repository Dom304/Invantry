<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    function login()
    {
        return view('public.public_loginPage');
    }

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $redirectRoute = route('home'); // default redirect
            if (auth()->user()->isBuyer()) {
                $redirectRoute = route('home');
            } elseif (auth()->user()->isModerator()) {
                $redirectRoute = route('moderatorDashboard');
            } elseif (auth()->user()->isManager()) {
                $redirectRoute = route('managerDashboard');
            } elseif (auth()->user()->isAdmin()) {
                $redirectRoute = route('adminDashboard');
            }
    
            return response()->json(['success' => true, 'redirect' => $redirectRoute]);
        }
    
        return response()->json(['success' => false, 'message' => "Login Failed"], 401);
    }


    function signUp()
    {
        return view('public.public_signUpPage');
    }

    function signUpPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $user = User::create($data);
        if (!$user) {
            return response()->json(['message' => 'Registration Failed'], 422);
        }
        return response()->json(['message' => 'Registration Successful, please log in']);
    }

    function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect(route('login')); 
    }
    
    function authenticate_role()
    {
        $userRole = auth()->user()->user_role;

        if ($userRole === User::ROLE_ADMIN) {
        } elseif ($userRole === User::ROLE_MODERATOR) {
        } elseif ($userRole === User::ROLE_MANAGER) {
        } else {
        }
    }
}
