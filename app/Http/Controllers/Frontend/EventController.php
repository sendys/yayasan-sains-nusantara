<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of upcoming events.
     */
    public function index()
    {
        $events = Event::upcoming()->paginate(6);
        return view('frontend.event.index', compact('events'));
    }

    /**
     * Display all events (including past events).
     */
    public function all()
    {
        $events = Event::published()
            ->orderBy('event_date', 'desc')
            ->paginate(6);
        return view('frontend.event.all', compact('events'));
    }

    /**
     * Display the specified event.
     */
    public function show($uuid)
    {
        $event = Event::where('uuid', $uuid)->firstOrFail();
        
        // Check if event is published (for non-admin users)
        if ($event->status !== 'published') {
            abort(404);
        }

        // Get related events (same category, upcoming)
        $relatedEvents = Event::published()
            ->where('id', '!=', $event->id)
            ->when($event->category, function ($query) use ($event) {
                return $query->where('category', $event->category);
            })
            ->upcoming()
            ->limit(3)
            ->get();

        return view('frontend.event.show', compact('event', 'relatedEvents'));
    }
}
