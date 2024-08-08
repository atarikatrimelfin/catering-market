<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }


    public function registered(Request $request)
    {
        $existingUser = User::where('email', $request->email)->exists();;
        if ($existingUser) {
            return redirect()->back()->withInput()->withErrors(['email' => 'Pengguna sudah terdaftar.']);
        }

        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login')->with('success', 'Silahkan Login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function ceklogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    public function handle($request, $next)
    {
        return Auth::onceBasic() ?: $next($request);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
