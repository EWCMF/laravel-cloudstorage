<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function login(Request $request) {
        $success = Auth::attempt($request->only('username', 'password'), $request->remember);

        if (!$success) {
            return back()->with('status', 'Invalid login details')->withInput();
        }

        return redirect('/');
    }
}
