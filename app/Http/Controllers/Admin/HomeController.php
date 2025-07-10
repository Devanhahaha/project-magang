<?php

namespace App\Http\Controllers\Admin;

use App\Models\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index() {
        $homes = Home::latest()->first();
        return view('adminpage.home.index' , compact('homes'));
    }

    public function store(Request $request) {
        $request->validate([
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|min:5|max:255|regex:/^[a-zA-Z0-9\s\.\,\-\_\(\)\&\']+$/',
            'subtitle' => 'required|string|max:255',
        ]);

        try {
            Home::create([
                'banner' => 'storage/' . $request->file('banner')->store('files/banner', 'public'),
                'title' => $request->title,
                'subtitle' => $request->subtitle,
            ]);

            return redirect()->route('home.index')->with('success', 'Home Content created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Home Content: ' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|min:5|max:255',
            'subtitle' => 'required|string|min:5|max:255',
        ]);

        try {
            $home = Home::find($id);

            if ($request->hasFile('banner')) {
                $oldPath = str_replace('storage/', 'public/', $home->banner);
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }

                $path = $request->file('banner')->store('files/banner', 'public');
                $home->banner = 'storage/' . $path;
            }

            $home->title = $request->title;
            $home->subtitle = $request->subtitle;

            $home->save();
            return redirect()->route('home.index')->with('success', 'Home Content update successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to update Home Content: ' . $e->getMessage());
        }
    }

    public function destroy(string $id) {
        $home = Home::find($id);
        $home->delete();
        return redirect()->route('home.index')->with('success', 'Home Content deleted successfully!');
    }
}
