<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class WelcomeController extends Controller
{
     public function welcome()
    {
        $ctaSubtitle = "Bersama Kita Wujudkan Perubahan Nyata";
        $ctaTitle    = "Dukung Gerakan Kami";
        $ctaButton   = "Donasi Sekarang";

        return view('welcome', compact(
            'ctaSubtitle',
            'ctaTitle',
            'ctaButton'
        ));
    }
}
