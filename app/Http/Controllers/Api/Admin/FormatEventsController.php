<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Format;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventCollection;

class FormatEventsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Format $format
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Format $format)
    {
        $this->authorize('view', $format);

        $search = $request->get('search', '');

        $events = $format
            ->events()
            ->search($search)
            ->latest()
            ->paginate();

        return new EventCollection($events);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Format $format
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Format $format)
    {
        $this->authorize('create', Event::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'organizer' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date'],
            'place' => ['required', 'max:255', 'string'],
            'banner' => ['required', 'max:255', 'string'],
            'identifier' => ['required', 'max:255', 'string'],
            'terms' => ['required', 'max:255', 'string'],
            'partner_id' => ['required', 'exists:partners,id'],
            'type_id' => ['required', 'exists:types,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'topic_mix_id' => ['required', 'exists:topic_mixes,id'],
        ]);

        $event = $format->events()->create($validated);

        return new EventResource($event);
    }
}
