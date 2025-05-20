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
    public function edit(Request $request): View
    {
        $profile = DB::select('CALL SPGetUserProfile(?)', [Auth::id()]);

        return view('profile.edit', [
            'profile' => $profile[0] ?? null,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $params = [
            Auth::id(),
            $request->first_name,
            $request->middle_name,
            $request->last_name,
            $request->date_of_birth,
            $request->street_name,
            $request->house_number,
            $request->addition,
            $request->postal_code,
            $request->city,
            $request->mobile,
            $request->email
        ];

        DB::select('CALL SPUpdateUserProfile(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', $params);
        
        return redirect()->route('dashboard')->with('success', 'Profiel bijgewerkt');
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
