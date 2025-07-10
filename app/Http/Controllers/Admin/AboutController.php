<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::latest()->first();
        return view('adminpage.about.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string|min:10|max:1000',
            'vision' => 'required',
            'mission' => 'required',
        ]);

        try {
            $about = About::find($id);

            if ($request->hasFile('image')) {
                $oldPath = str_replace('storage/', 'public/', $about->image);
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }

                $path = $request->file('image')->store('files/about', 'public');
                $about->image = 'storage/' . $path;
            }

            $about->description = $request->description;
            $about->vision = $request->vision;
            $about->mission = $request->mission;

            $about->save();

            return redirect()->route('about.index')->with('success', 'Data About Content Successfully Updated!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to update About Content: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
