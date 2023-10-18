<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
    function login() {
        return view('public.public_loginPage');
    }
    
    function loginPost(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with("error", "Login Failed");
    }
    
    function signUp() {
        return view('public.public_signUpPage');
    }

    function signUpPost(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

       $data['name'] = $request->name;
       $data['email'] = $request->email;
       $data['password'] = $request->password;
       $user = User::create($data);
       if(!$user) {
        return redirect(route('signUp'))->with("error", "Registration Failed");
       }
        return redirect(route('login'))->with("success", "Registration Successful, please log in");
    }

    function logout() {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
    
    function authenticate_role() {
        $userRole = auth()->user()->user_role;

        if ($userRole === User::ROLE_ADMIN) {
        } elseif ($userRole === User::ROLE_MODERATOR) {
        } elseif ($userRole === User::ROLE_MANAGER) {
        } else {
        }
    }
}
