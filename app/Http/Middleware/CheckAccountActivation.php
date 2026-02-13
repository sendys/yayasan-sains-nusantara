<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountActivation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check if user account is activated
            if (! $user->is_activated) {
                // Allow access to activation routes
                $allowedRoutes = [
                    'account.activate',
                    'account.resend-activation.form',
                    'account.resend-activation',
                    'logout',
                ];

                if (! in_array($request->route()->getName(), $allowedRoutes)) {
                    return redirect()->route('account.resend-activation.form')
                        ->with('warning', 'Silakan aktivasi akun Anda terlebih dahulu untuk mengakses fitur ini.');
                }
            }
        }

        return $next($request);
    }
}
