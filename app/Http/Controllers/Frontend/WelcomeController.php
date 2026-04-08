<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Event;
use Illuminate\View\View;

class WelcomeController extends Controller
{
     public function welcome()
    {
        $ctaSubtitle = __('cta.subtitle');
        $ctaTitle    = __('cta.title');
        $ctaButton   = __('cta.button');

        // Get latest published blogs for homepage
        $blogs = Blog::published()
                   ->latest()
                   ->take(3)
                   ->get();

        // Get upcoming events for homepage (show 3)
        $events = Event::published()
                     ->latest()
                     ->take(6)
                     ->get();

        return view('welcome', compact(
            'ctaSubtitle',
            'ctaTitle',
            'ctaButton',
            'blogs',
            'events'
        ));
    }
}
