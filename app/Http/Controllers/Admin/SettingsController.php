<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index() {
        $user = auth()->user();
        return view('adminpage.settings.index', compact('user'));
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|same:confirm_password',
            'contact' => 'required|string',
        ]);

        try {
            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact = $request->contact;
             if ($request->filled('current_password') && $request->filled('new_password')) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
            } else {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }
        }

            $user->save();

            return redirect()->route('settings.index')->with('success', 'Data User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to updated Data User: ' . $e->getMessage());
        }
    }
}
