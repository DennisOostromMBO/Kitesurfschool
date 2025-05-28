<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        if (!Auth::check() || Auth::user()->role !== 'eigenaar') {
            abort(403, 'Alleen de eigenaar heeft toegang tot deze pagina');
        }
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'mobile' => 'required|string|max:15',
        ]);

        DB::statement('CALL UpdateUserProfile(?, ?, ?, ?, ?, ?)', [
            Auth::id(),
            $request->name,
            $request->address,
            $request->city,
            $request->date_of_birth,
            $request->mobile,
        ]);

        return redirect()->route('home')->with('success', 'Profiel bijgewerkt!');
    }

    public function index()
    {
        $users = DB::table('users')->get();
        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        try {
            // Prevent changing own role
            if ($id == Auth::id()) {
                throw new \Exception('Je kunt je eigen rol niet wijzigen');
            }

            $request->validate([
                'role' => 'required|in:klant,instructor,eigenaar'
            ]);

            // Check if user exists
            $user = DB::table('users')->where('id', $id)->first();
            if (!$user) {
                throw new \Exception('Gebruiker niet gevonden');
            }

            DB::beginTransaction();

            // Update user role
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'role' => $request->role,
                    'updated_at' => now()
                ]);

            // If changing to instructor, create instructor record if it doesn't exist
            if ($request->role === 'instructor') {
                $existingInstructor = DB::table('instructors')
                    ->where('person_id', $user->person_id)
                    ->first();

                if (!$existingInstructor && $user->person_id) {
                    DB::table('instructors')->insert([
                        'person_id' => $user->person_id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            DB::commit();

            Log::info('Role updated successfully', [
                'user_id' => $id,
                'new_role' => $request->role
            ]);

            return redirect()->route('users.index')
                ->with('success', 'Rol succesvol gewijzigd naar ' . ucfirst($request->role));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Role update failed', ['error' => $e->getMessage()]);
            return redirect()->back()
                ->with('error', 'Er is iets misgegaan bij het wijzigen van de rol: ' . $e->getMessage());
        }
    }
}
