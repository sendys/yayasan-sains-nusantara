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

    return view('frontend.tentang', compact('section'));

    }

}
