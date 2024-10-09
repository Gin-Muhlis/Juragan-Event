<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\TopicMix;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventCollection;

class TopicMixEventsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TopicMix $topicMix
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TopicMix $topicMix)
    {
        $this->authorize('view', $topicMix);

        $search = $request->get('search', '');

        $events = $topicMix
            ->events()
            ->search($search)
            ->latest()
            ->paginate();

        return new EventCollection($events);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TopicMix $topicMix
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TopicMix $topicMix)
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
            'format_mix_id' => ['required', 'exists:format_mixes,id'],
        ]);

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('public');
        }

        $event = $topicMix->events()->create($validated);

        return new EventResource($event);
    }
}
