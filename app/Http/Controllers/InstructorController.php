<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class InstructorController extends Controller
{
    public function __construct()
    {
        if (!Auth::check()) {
            abort(401, 'Niet ingelogd');
        }
        
        if (Auth::user()->role !== 'instructor') {
            abort(403, 'Geen toegang tot deze pagina');
        }
    }

    public function index()
    {
        $instructors = DB::select('CALL SPGetAllInstructors()');

        return view('instructors.index', compact('instructors'));
    }

    public function destroy($id): RedirectResponse
    {
        DB::statement('CALL SPDeleteInstructor(?)', [$id]);
        return redirect()->route('instructors.index')->with('success', 'Instructeur succesvol verwijderd.');
    }
}
