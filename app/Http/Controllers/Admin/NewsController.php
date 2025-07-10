<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
{
    $query = News::orderBy('id', 'desc');

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('category', 'LIKE', "%{$search}%");
    }

    $news = $query->get();

    return view('adminpage.news.index', compact('news'));
}


    public function store(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|string|max:255',
            'title' => 'required|string|min:5|max:255|regex:/^[a-zA-Z0-9\s\.\,\-\_\(\)\&\']+$/',
            'description' => 'required|string|min:10|max:1000',
            'tanggal' => 'required|date_format:Y-m-d',
        ]);

        try {
            News::create([
                'image' => 'storage/' . $request->file('image')->store('files/news', 'public'),
                'category' => $request->category,
                'title' => $request->title,
                'description' => $request->description,
                'tanggal' => $request->tanggal,
            ]);

            return redirect()->route('news.index')->with('success', 'News Content created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to create News Content: ' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|string|max:255',
            'title' => 'required|string|min:5|max:255|regex:/^[a-zA-Z0-9\s\.\,\-\_\(\)\&\']+$/',
            'description' => 'required|string|min:10|max:1000',
            'tanggal' => 'required|date_format:Y-m-d',
        ]);

        try {
            $new = News::find($id);

        if ($request->hasFile('image')) {
            $oldPath = str_replace('storage/', 'public/', $new->image);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }

            $path = $request->file('image')->store('files/news', 'public');
            $new->image = 'storage/' . $path;
        }

        $new->category = $request->category;
        $new->title = $request->title;
        $new->description = $request->description;
        $new->tanggal = $request->tanggal;

        $new->save();

        return redirect()->route('news.index')->with('success', 'News Content updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to updated News Content: ' . $e->getMessage());
        }
    }

    public function destroy(string $id) {
        $new = News::find($id);
        $new->delete();
        return redirect()->route('news.index')->with('success', 'News Content deleted successfully!');
    }
}
