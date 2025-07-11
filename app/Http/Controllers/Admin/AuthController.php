<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.auth-login-cover');
    }

    public function authentication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'email dan password tidak valid!'
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->filled('remember'));
            return redirect()->route('dashboard')->with('success', 'Login Successfully!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Successfully!');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'contact' => 'required',
            'trems' => 'accepted',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
        ], [
            'password.confirmed' => 'Password confirmation does not match.',
            'trems.accepted' => 'You must accept the terms and conditions.',
        ]);

        if ($validator->fails()) {
            // dd($validator->errors()->all());
            return redirect()->back()
                ->with([
                    'status' => 'error',
                    'message' => $validator->errors()->first() 
                ])
                ->withInput();
        }        

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
        ])->assignRole('admin');

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice')->with('success', 'Registration successful! You can now Verify Email.');
    }
}
