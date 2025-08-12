<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    // Register Page
    public function create()
    {
        // route = /register
        return Inertia::render('Homepage/Auth/Register');
    }
    // Register Logic
    public function register(Request $request)
    {
        // route = /register [POST]
        $a = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:' . User::class,
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        // dd($a);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => 4,
        ]);

        if ($user) {
            $request->session()->regenerate();
            return redirect()->route('mycourse')->with('success', 'Anda berhasil daftar!');
        }
        return redirect()->back()->with('error', 'Gagal mendaftar!');
    }

    public function enter() {
        return Inertia::render('Homepage/Auth/Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Session::flash('success', 'Anda berhasil Login!');
            if (Auth::user()->role_id != 4) {
                return redirect()->intended(route('dashboard'))->with('success', 'Anda berhasil login!');
            }
            return redirect()->intended(route('mycourse'))->with('success', 'Anda berhasil login!');
        } else {
            return redirect()->route('login')->with('error' , 'Gagal login!');
        }
    }

    // Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda')->with('message' , 'Anda telah logout!');
    }
}
