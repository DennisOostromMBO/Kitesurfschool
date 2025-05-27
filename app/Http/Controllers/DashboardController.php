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
        
        $package = DB::table('packages as p')
            ->join('user_packages as up', 'p.id', '=', 'up.package_id')
            ->join('locations as l', 'up.location_id', '=', 'l.id')
            ->join('timeslots as t', 'up.timeslot_id', '=', 't.id')
            ->where('up.user_id', $userId)
            ->select('p.*', 'l.name as location_name', 't.display_name as timeslot', 'up.start_date')
            ->orderBy('up.created_at', 'desc')
            ->first();
            
        Log::info('Dashboard package data:', ['package' => $package, 'user_id' => $userId]);
            
        return view('dashboard', ['package' => $package]);
    }
}
