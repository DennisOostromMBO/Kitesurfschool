<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $packages = DB::select('CALL SPGetAllPackages()');
        $locations = DB::table('locations')->get();
        return view('index', ['packages' => $packages, 'locations' => $locations]);
    }
}
