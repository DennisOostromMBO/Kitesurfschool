<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $packages = DB::select('CALL SPGetAllPackages()');
        return view('index', ['packages' => $packages]);
    }
}
