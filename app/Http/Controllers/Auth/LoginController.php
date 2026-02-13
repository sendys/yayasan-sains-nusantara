<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Validate the user login request.
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'g-recaptcha-response.required' => 'Mohon verifikasi bahwa Anda bukan robot.',
            'g-recaptcha-response.captcha' => 'Verifikasi CAPTCHA gagal, silakan coba lagi.',
        ]);

        // Cek apakah user memiliki perusahaan dengan is_status = 0 atau expired
        $user = User::where($this->username(), $request->input($this->username()))->first();

        if ($user && $user->perusahaan) {
            // Cek status non-aktif
            if ($user->perusahaan->is_status == '0') {
                session()->flash('show_expired_modal', true);
                session()->flash('expired_company_name', $user->perusahaan->name);

                throw ValidationException::withMessages([
                    $this->username() => [''],
                ]);
            }

            // Cek expired license
            if ($user->perusahaan->isExpired()) {
                session()->flash('show_expired_modal', true);
                session()->flash('expired_company_name', $user->perusahaan->name);

                throw ValidationException::withMessages([
                    $this->username() => [''],
                ]);
            }
        }
    }

    /**
     * Override authenticated method to double-check license after login
     */
    protected function authenticated(Request $request, $user)
    {
        // Double check license status after authentication
        if ($user->perusahaan) {
            if ($user->perusahaan->is_status == '0' || $user->perusahaan->isExpired()) {
                $this->guard()->logout();

                session()->flash('show_expired_modal', true);
                session()->flash('expired_company_name', $user->perusahaan->name);

                return redirect()->route('login')
                    ->withErrors([$this->username() => '']);
            }
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the failed login response instance.
     * Log failed login attempts for security monitoring.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        Log::warning('Failed login attempt', [
            'email' => $request->input($this->username()),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'timestamp' => now()->toDateTimeString(),
        ]);

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
