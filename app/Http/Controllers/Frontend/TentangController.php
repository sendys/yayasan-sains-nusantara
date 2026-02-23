<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class TentangController extends Controller
{
    public function tentang()
    {
        $section = Cache::rememberForever(
            \App\Models\frontend\TentangKami::CACHE_KEY,
            function () {
                return \App\Models\frontend\TentangKami::first();
            }
        );

        return view('frontend.visi_misi', compact('section'));

    }

    public function sejarah()
    {
        $section = Cache::rememberForever(
            \App\Models\frontend\TentangKami::CACHE_KEY,
            function () {
                return \App\Models\frontend\TentangKami::first();
            }
        );

        return view('frontend.sejarah', compact('section'));

    }

    public function pengurus()
    {
        $section = Cache::rememberForever(
            \App\Models\frontend\TentangKami::CACHE_KEY,
            function () {
                return \App\Models\frontend\TentangKami::first();
            }
        );

        return view('frontend.pengurus', compact('section'));

    }
}
