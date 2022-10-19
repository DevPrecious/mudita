<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function show_register(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

        $packages = Package::latest()->get();
        // dd(session()->pull('referrer'));

        return view('auth.register', compact('packages'));
    }


    public function register(Request $request)
    {

        $referrer = User::whereUsername(session()->pull('referrer'))->first();

        // dd($referrer);

        $request->validate([
            'username' => 'required|string|unique:users',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'same:password'
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'package_id' => $request->package,
            'referrer_id' => $referrer ? $referrer->id : null,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back('error', 'Error creating account');
        }
    }

    public function show_login()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:6'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Incorrect username or password');
        } else {
            $credentials = $request->only('username', 'password');
            $cred = Auth::attempt($credentials);
            if ($cred) {
                return redirect()->intended('dashboard');
            } else {
                return redirect()->back('error', 'Error processing request');
            }
        }
    }
}
