<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Services;
use App\Models\Portofolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $user = auth()->user();
        $totalNews = News::count();
        $totalPortofolio = Portofolio::count();
        $totalServices = Services::count();

        $targetNews = 50;
        $targetPortofolio = 50;
        $targetServices = 50;

        $persenNews = min(($totalNews / $targetNews) * 100, 100);
        $persenPortofolio = min(($totalPortofolio / $targetPortofolio) * 100, 100);
        $persenServices = min(($totalServices / $targetServices) * 100, 100);

        return view('adminpage.dashboard.dashboard', compact(
            'user',
            'totalNews',
            'totalPortofolio',
            'totalServices',
            'persenNews',
            'persenPortofolio',
            'persenServices',
        ));
    }
}
