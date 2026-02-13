<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.license');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $expiredLicense = null;
        $expiringSoonLicense = null;

        if ($user->perusahaan) {
            // Cek apakah lisensi sudah expired
            if ($user->perusahaan->isExpired()) {
                $expiredLicense = $user->perusahaan;
            }
            // Cek apakah lisensi akan expired dalam 7 hari
            elseif ($user->perusahaan->isExpiringSoon(7)) {
                $expiringSoonLicense = $user->perusahaan;
            }
        }

        return view('home', compact('expiredLicense', 'expiringSoonLicense'));
    }
}
