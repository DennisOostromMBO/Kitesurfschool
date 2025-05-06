<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = DB::select('CALL SPGetAllCustomers()');

        return view('customers.index', compact('customers'));
    }
}
