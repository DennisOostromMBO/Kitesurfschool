<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function purchase($id)
    {
        DB::table('user_packages')->insert([
            'user_id' => Auth::id(),
            'package_id' => $id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('dashboard')->with('success', 'Pakket gekocht!');
    }
}
