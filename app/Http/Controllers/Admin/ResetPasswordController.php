<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email not registered in our system.',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ])->withInput();
        }

        try {
            // Buat token
            $token = Str::random(60);

            // Simpan ke DB
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $request->email],
                [
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]
            );

            // Kirim email
            $resetLink = url('/reset-password/' . $token);
            Mail::raw("Click this link to reset your password: $resetLink", function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password Link');
            });

            return back()->with([
                'status' => 'success',
                'message' => 'Reset password link has been sent to your email!'
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'status' => 'error',
                'message' => 'Email not registered in our system. Please check your email address and try again.'
            ]);
        }
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
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

        $tokenData = DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $request->token, 'created_at' => Carbon::now()]
        );

        if (!$tokenData) {
            return back()->with('error', 'Invalid or expired token.');
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus token setelah berhasil
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password reset successful! You can now login.');
    }
}
