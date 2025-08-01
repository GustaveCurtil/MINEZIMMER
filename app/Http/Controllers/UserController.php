<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {    
        $validated = $request->validate([
            'register_name' => 'required|string|max:255|min:2|unique:users,name',
            'register_password' => 'required|confirmed|min:2',
            'register_agree' => 'accepted',
        ]);

        $user = User::create([
            'name' => $validated['register_name'],
            'password' => Hash::make($validated['register_password']),
        ]);

        Auth::login($user);

        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Je bent uitgelogd');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        }

        return redirect()->back();
    }
}
