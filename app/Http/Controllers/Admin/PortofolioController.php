<?php

namespace App\Http\Controllers\Admin;

use App\Models\Portofolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Portofolio::orderBy('id', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('category', 'LIKE', "%{$search}%");
        }

        $portofolios = $query->get();

        return view('adminpage.portofolio.index', compact('portofolios'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|string|max:255',
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10|max:1000',
            'tanggal' => 'required|date_format:Y-m-d',
            'techstack' => 'required|string|min:10|max:1000',
        ]);

        try {
            $imagePath = 'storage/' . $request->file('image')->store('files/portofolio', 'public');

            Portofolio::create([
                'image' => $imagePath,
                'category'  => $request->category,
                'title'  => $request->title,
                'description'  => $request->description,
                'tanggal'  => $request->tanggal,
                'techstack' => $request->techstack,
            ]);

            return redirect()->route('portofolio.index')->with('success', 'Portofolio Content created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to create Portofolio Content: ' . $e->getMessage());
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
        $portofolio = Portofolio::find($id);

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|string|max:255',
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10|max:1000',
            'tanggal' => 'required|date_format:Y-m-d',
            'techstack' => 'required|string|min:10|max:1000',
        ]);

        try {
            if ($request->hasFile('image')) {
                $oldPath = str_replace('storage/', 'public/', $portofolio->image);
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }

                $path = $request->file('image')->store('files/portofolio', 'public');
                $portofolio->image = 'storage/' . $path;
            }

            $portofolio->category = $request->category;
            $portofolio->title = $request->title;
            $portofolio->description = $request->description;
            $portofolio->tanggal = $request->tanggal;
            $portofolio->techstack = $request->techstack;

            $portofolio->save();

            return redirect()->route('portofolio.index')->with('success', 'Portofolio Content updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to updated Portofolio Content: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portofolio = Portofolio::find($id);
        $portofolio->delete();
        return redirect()->route('portofolio.index')->with('success', 'Portofolio Content deleted successfully!');
    }
}
