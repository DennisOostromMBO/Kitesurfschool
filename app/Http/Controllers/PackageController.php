<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function purchase(Request $request, $id)
    {
        if (Auth::user()->role === 'instructor') {
            abort(403, 'Instructeurs kunnen geen pakketten kopen');
        }

        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'timeslot_id' => 'required|exists:timeslots,id',
            'start_date' => 'required|date|after:yesterday',
        ]);

        DB::table('user_packages')->insert([
            'user_id' => Auth::id(),
            'package_id' => $id,
            'location_id' => $request->location_id,
            'timeslot_id' => $request->timeslot_id,
            'start_date' => $request->start_date,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('dashboard')->with('success', 'Pakket succesvol gekocht!');
    }
}
