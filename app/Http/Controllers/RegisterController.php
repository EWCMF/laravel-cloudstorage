<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index() {
        return view('register');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'username' => 'required|max:255',
            'password' => 'required|confirmed|min:8|max:20',
        ]);

        User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        Auth::attempt($request->only('username', 'password'));

        return redirect()->route('home');
    }
}
