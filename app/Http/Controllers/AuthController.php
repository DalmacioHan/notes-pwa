<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
    }
    public function register(Request $request)
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {

        $role = 0;

        $validate = $request->validate([
            'name'=> 'required|max:255',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|min:6',
        ]);

        if ($request->admin_key === 'admin123') {
            $role = 1;
        }

        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => bcrypt($validate['password']),
            'role' => $role,
        ]);



        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
