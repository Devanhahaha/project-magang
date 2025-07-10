<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $user = auth()->user();
        return view('adminpage.profile.index', compact('user'));
    }
}
