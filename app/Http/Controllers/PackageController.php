<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function purchase(Request $request, $id)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id'
        ]);

        $userId = Auth::id();

        DB::table('user_packages')->insert([
            'user_id' => $userId,
            'package_id' => $id,
            'location_id' => $request->location_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('dashboard')->with('success', 'Pakket succesvol gekocht!');
    }
}
