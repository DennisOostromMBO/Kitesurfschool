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
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        DB::beginTransaction();
        try {
            // First create a person record
            $personId = DB::table('persons')->insertGetId([
                'first_name' => '',
                'last_name' => '',
                'date_of_birth' => now(),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Then create the user with the person_id
            $user = User::create([
                'name' => 'Gebruiker',
                'email' => $request->email,
                'password' => Hash::make(Str::random(40)),
                'role' => 'klant',
                'verification_token' => Str::random(64),
                'person_id' => $personId  // Make sure person_id is fillable in User model
            ]);

            DB::commit();
            
            Mail::to($user->email)->send(new VerifyEmail($user));

            return redirect()->route('verification.notice')
                ->with('email', $user->email);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['email' => 'Registratie mislukt: ' . $e->getMessage()]);
        }
    }
}
