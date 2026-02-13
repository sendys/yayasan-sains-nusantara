<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCompanyLicense
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Jika user memiliki perusahaan dan status perusahaan tidak aktif atau lisensi expired
        if ($user && $user->perusahaan && ($user->perusahaan->is_status == '0' || $user->perusahaan->isExpired())) {
            Auth::logout();

            // Set session untuk modal
            session()->flash('show_expired_modal', true);
            session()->flash('expired_company_name', $user->perusahaan->name);

            return redirect()->route('login')
                ->withErrors(['email' => 'Lisensi perusahaan Anda telah dinonaktifkan atau sudah berakhir. Silakan hubungi administrator.']);
        }

        return $next($request);
    }
}
