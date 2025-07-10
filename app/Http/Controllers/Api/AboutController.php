<?php

namespace App\Http\Controllers\Api;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::latest()->first();

        if ($about) {
            return new AboutResource($about);
        }

        return response()->json([
            'message' => 'About data not found.'
        ], 404);
    }
}
