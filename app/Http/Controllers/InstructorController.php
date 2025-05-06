<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class InstructorController extends Controller
{
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
