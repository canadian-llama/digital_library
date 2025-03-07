<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request,)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $remember = $request->input('remember');


        if (Auth::attempt($validated, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();


            return redirect()->route('user.dashboard')->with('success', 'User Logged in successfully');
        }


        throw ValidationException::withMessages([
            'email' => 'Incorrect E-mail or Password'
        ]);
    }


    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'username' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);


        $user = User::create($validated);

        Auth::login($user);

        if ($request->input('role') == 'admin') {
            return redirect()->route('user.dashboard')->with('success', 'Welcome ' . $user->name);
        }

        return redirect()->route('user.dashboard')->with('success', 'Welcome ' . $user->name);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'User Logged Out');
    }
}
