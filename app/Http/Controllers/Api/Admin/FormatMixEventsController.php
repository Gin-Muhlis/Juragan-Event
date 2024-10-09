<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\FormatMix;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventCollection;

class FormatMixEventsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FormatMix $formatMix
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FormatMix $formatMix)
    {
        $this->authorize('view', $formatMix);

        $search = $request->get('search', '');

        $events = $formatMix
            ->events()
            ->search($search)
            ->latest()
            ->paginate();

        return new EventCollection($events);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FormatMix $formatMix
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormatMix $formatMix)
    {
        $this->authorize('create', Event::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'organizer' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date'],
            'place' => ['required', 'max:255', 'string'],
            'identifier' => ['required', 'max:255', 'string'],
            'terms' => ['required', 'max:255', 'string'],
            'banner' => ['image', 'max:5120', 'required'],
            'partner_id' => ['required', 'exists:partners,id'],
            'type_id' => ['required', 'exists:types,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'topic_mix_id' => ['required', 'exists:topic_mixes,id'],
        ]);

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('public');
        }

        $event = $formatMix->events()->create($validated);

        return new EventResource($event);
    }
}
