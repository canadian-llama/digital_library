<?php

namespace App\Http\Controllers;

use App\Events\NotificationSystem;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
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


            return redirect('/admin-dashboard')->with('success', 'User Logged in successfully');
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
        event(new Registered($user));
        return redirect()->route('user.dashboard')->with('success', 'Welcome ' . $user->name);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // event(new NotificationSystem('Logged out Successfully', Auth::user()->id, 'logout'));
        return redirect('/')->with('success', 'User Logged Out');
    }

    // public function verifyNotice()
    // {
    //     return view('auth.verify-email');
    // }

    // public function verifyEmail(EmailVerificationRequest $request)
    // {
    //     $request->fulfill();
    //     return redirect()->route('user.dashboard');
    // }

    // public  function verifyHandler(Request $request)
    // {
    //     $request->user()->sendEmailVerificationNotification();

    //     return back()->with('succes', 'Verification link sent!');
    // }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function validateForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function validateResetPassword(Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PasswordReset
        ? redirect()->route('landing')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
}
}
