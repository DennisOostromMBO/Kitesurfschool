<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();
        Log::info('Role Check', [
            'user_role' => $user->role ?? 'none',
            'required_role' => $role,
            'user_email' => $user->email ?? 'none'
        ]);

        if (!$user || $user->role !== $role) {
            return redirect('/')->with('error', 'Je hebt geen toegang tot deze pagina.');
        }

        return $next($request);
    }
}
