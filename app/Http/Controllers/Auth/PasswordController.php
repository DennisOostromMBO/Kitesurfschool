<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'min:12',
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ], [
            'password.regex' => 'Het wachtwoord moet minimaal één hoofdletter, één cijfer en één leesteken bevatten.',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('home')
            ->with('success', 'Je account is geactiveerd en je bent nu ingelogd!');
    }

    public function showSetPasswordForm(string $token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();
        return view('auth.set-password', ['token' => $token, 'email' => $user->email]);
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:12',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ]
        ]);

        $user = User::where('email', $request->email)
                    ->where('verification_token', $request->token)
                    ->firstOrFail();

        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Je account is geactiveerd en je wachtwoord is ingesteld!');
    }
}
