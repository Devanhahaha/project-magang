<?php

namespace App\Http\Controllers\Admin;

use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Services::orderBy('id', 'desc')->get();
        return view('adminpage.services.index', compact('services'));
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
        $request->validate([
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|min:5|max:255',
            'subtitle' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10|max:1000',
        ]);

        try {
            Services::create([
                'banner' => 'storage/' . $request->file('banner')->store('files/services', 'public'),
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'description' => $request->description,
            ]);

            return redirect()->route('services.index')->with('success', 'Services Content created successfully!');
        } catch(\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to create Services Content: ' . $e->getMessage());
        }
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
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|min:5|max:255',
            'subtitle' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10|max:1000',
        ]);

        try {
            $service = Services::find($id);

            if ($request->hasFile('banner')) {
                $oldPath = str_replace('storage/', 'public/', $service->banner);
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }

                $path = $request->file('banner')->store('files/services', 'public');
                $service->banner = 'storage/' . $path;
            }

            $service->title = $request->title;
            $service->subtitle = $request->subtitle;
            $service->description = $request->description;

            $service->save();
            return redirect()->route('services.index')->with('success', 'Services Content updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to updated Services Content: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Services::find($id);
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Services Content deleted successfully!');
    }
}
