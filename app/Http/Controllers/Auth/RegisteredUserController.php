<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Begin transaction
        DB::beginTransaction();
        try {
            // Create person record
            $personId = DB::table('persons')->insertGetId([
                'first_name' => $request->name, // Initially use full name as first name
                'last_name' => '', // Empty for now
                'date_of_birth' => now(), // Default date
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create contact record
            DB::table('contacts')->insert([
                'person_id' => $personId,
                'street_name' => '',
                'house_number' => '',
                'postal_code' => '',
                'city' => '',
                'mobile' => '',
                'email' => $request->email,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create user with person_id
            $user = User::create([
                'name' => $request->name ?? 'Gebruiker', // Standaardwaarde voor 'name'
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'person_id' => $personId,
                'role' => 'klant',
            ]);

            DB::commit();

            Auth::login($user);

            return redirect('/');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
