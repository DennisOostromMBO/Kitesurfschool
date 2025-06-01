<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'instructor') {
            // Get instructor's packages
            $instructorId = DB::table('instructors')
                ->where('person_id', $user->person_id)
                ->value('id');
                
            $instructorPackages = DB::select('CALL SPGetInstructorPackages(?)', [$instructorId]);

            // Add rejection data
            foreach ($instructorPackages as $package) {
                $rejection = DB::table('package_rejections')
                    ->where('user_package_id', $package->user_package_id)
                    ->first();
                $package->rejection = $rejection;
            }

            return view('dashboard', ['instructorPackages' => $instructorPackages]);
        }
        elseif ($user->role === 'eigenaar') {
            return view('dashboard');
        }
        else {
            // Get customer's packages with rejections
            $packages = DB::table('user_packages as up')
                ->join('packages as p', 'up.package_id', '=', 'p.id')
                ->join('locations as l', 'up.location_id', '=', 'l.id')
                ->join('timeslots as t', 'up.timeslot_id', '=', 't.id')
                ->leftJoin('package_rejections as pr', 'up.id', '=', 'pr.user_package_id')
                ->where('up.user_id', $user->id)
                ->select(
                    'up.id',
                    'p.name',
                    'p.description',
                    'l.name as location_name',
                    'up.start_date',
                    't.display_name as timeslot',
                    'pr.id as rejection_id',
                    'pr.reason as rejection_reason',
                    'pr.status as rejection_status'
                )
                ->get()
                ->map(function ($package) {
                    $package->rejection = $package->rejection_id ? (object)[
                        'reason' => $package->rejection_reason,
                        'status' => $package->rejection_status
                    ] : null;
                    return $package;
                });

            return view('dashboard', ['packages' => $packages]);
        }
    }
}
