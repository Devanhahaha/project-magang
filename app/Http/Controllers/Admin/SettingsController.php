<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Component;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index() {
        $user = auth()->user();
        $components = Component::first();
        return view('adminpage.settings.index', compact('user', 'components'));
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|same:confirm_password',
            'contact' => 'required|string',
            'logo_apk' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_apk' => 'required|string|min:5|max:255',
        ]);

        try {
            $component = Component::first();

            if ($request->hasFile('logo_apk')) {
                $oldPath = str_replace('storage/', 'public/', $component->logo_apk);
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }
    
                $path = $request->file('logo_apk')->store('files/components', 'public');
                $component->logo_apk = 'storage/' . $path;
            }

            $component->nama_apk = $request->nama_apk;

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
            $component->save();

            return redirect()->route('settings.index')->with('success', 'Data updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to updated Data User: ' . $e->getMessage());
        }
    }
}
