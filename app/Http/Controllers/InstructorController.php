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
        
        if (!in_array(Auth::user()->role, ['instructor', 'eigenaar'])) {
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
        if (Auth::user()->role !== 'eigenaar') {
            abort(403, 'Alleen de eigenaar kan instructeurs verwijderen');
        }

        DB::statement('CALL SPDeleteInstructor(?)', [$id]);
        return redirect()->route('instructors.index')
            ->with('success', 'Instructeur succesvol verwijderd.');
    }
}
