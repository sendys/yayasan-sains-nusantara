<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SejarahController extends Controller
{
    public function sejarah()
    {
        $section = Cache::rememberForever(
            \App\Models\frontend\Sejarah::CACHE_KEY,
            function () {
                return \App\Models\frontend\Sejarah::first();
            }
        );

        return view('frontend.sejarah', compact('section'));

    }

}
