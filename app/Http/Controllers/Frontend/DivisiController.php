<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class DivisiController extends Controller
{
    public function divisi()
    {
        $section = Cache::rememberForever(
            \App\Models\frontend\Divisi::CACHE_KEY,
            function () {
                return \App\Models\frontend\Divisi::first();
            }
        );

        return view('frontend.divisi', compact('section'));
    }
}
