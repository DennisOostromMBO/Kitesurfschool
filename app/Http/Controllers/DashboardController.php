<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        // Fetch package data using JOIN with user_packages table
        $package = DB::table('packages as p')
            ->join('user_packages as up', 'p.id', '=', 'up.package_id')
            ->where('up.user_id', $userId)
            ->select('p.name', 'p.description', 'p.price')
            ->orderBy('up.created_at', 'desc')
            ->first();

        Log::info('Dashboard package data:', ['package' => $package, 'user_id' => $userId]);
            
        return view('dashboard', ['package' => $package]);
    }
}
