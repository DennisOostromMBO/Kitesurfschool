<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            ->select(
                'p.*', 
                'l.name as location_name', 
                't.display_name as timeslot',
                'up.start_date'
            )
            ->orderBy('up.created_at', 'desc')
            ->first();

        if ($package) {
            // Get instructors for this package
            $instructors = DB::table('instructors as i')
                ->join('package_instructors as pi', 'i.id', '=', 'pi.instructor_id')
                ->join('persons as p', 'i.person_id', '=', 'p.id')
                ->where('pi.package_id', $package->id)
                ->select('p.full_name as instructor_name')
                ->get();

            $package->instructors = $instructors;
        }
            
        return view('dashboard', ['package' => $package]);
    }
}
