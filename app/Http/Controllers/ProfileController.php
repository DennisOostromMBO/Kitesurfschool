<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $user = Auth::user();
        
        // Get person data
        $person = DB::table('persons')
            ->where('id', $user->person_id)
            ->first();
            
        // Get contact data
        $contact = DB::table('contacts')
            ->where('person_id', $user->person_id)
            ->first();

        if (!$contact) {
            // Create default contact record if none exists
            $contactId = DB::table('contacts')->insertGetId([
                'person_id' => $user->person_id,
                'street_name' => '',
                'house_number' => '',
                'postal_code' => '',
                'city' => '',
                'mobile' => '',
                'email' => $user->email,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            $contact = DB::table('contacts')->where('id', $contactId)->first();
        }

        return view('profile.edit', [
            'profile' => (object)[
                'first_name' => $person->first_name ?? '',
                'middle_name' => $person->middle_name ?? '',
                'last_name' => $person->last_name ?? '',
                'date_of_birth' => $person->date_of_birth ?? '',
                'street_name' => $contact->street_name ?? '',
                'house_number' => $contact->house_number ?? '',
                'addition' => $contact->addition ?? '',
                'postal_code' => $contact->postal_code ?? '',
                'city' => $contact->city ?? '',
                'mobile' => $contact->mobile ?? '',
                'email' => $user->email
            ]
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'street_name' => 'required|string|max:255',
            'house_number' => 'required|string|max:10',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            // Update person
            DB::table('persons')
                ->where('id', $user->person_id)
                ->update([
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'date_of_birth' => $request->date_of_birth,
                    'updated_at' => now(),
                ]);

            // Update contact
            DB::table('contacts')
                ->where('person_id', $user->person_id)
                ->update([
                    'street_name' => $request->street_name,
                    'house_number' => $request->house_number,
                    'addition' => $request->addition,
                    'postal_code' => $request->postal_code,
                    'city' => $request->city,
                    'mobile' => $request->mobile,
                    'updated_at' => now(),
                ]);

            DB::commit();
            return redirect()->route('dashboard')
                ->with('success', 'Profiel succesvol bijgewerkt!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Profiel update mislukt: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
