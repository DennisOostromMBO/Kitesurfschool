<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = DB::select('CALL SPGetAllCustomers()');

        return view('customers.index', compact('customers'));
    }

    public function destroy($id): RedirectResponse
    {
        DB::statement('CALL SPDeleteCustomer(?)', [$id]);
        return redirect()->route('customers.index')->with('success', 'Klant succesvol verwijderd.');
    }
}
