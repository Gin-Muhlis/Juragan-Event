<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Event;
use App\Models\TopicMix;
use App\Models\Organizer;
use App\Models\FormatMix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\EventStoreRequest;
use App\Http\Requests\Admin\EventUpdateRequest;

class EventController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Event::class);

        $events = Event::get();

        return view('admin.app.events.index', compact('events'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Event::class);

        $cities = City::pluck('city_name', 'id');
        $organizers = Organizer::pluck('name', 'id');
        $formatMixes = FormatMix::pluck('format', 'id');
        $topicMixes = TopicMix::pluck('topic', 'id');

        return view(
            'admin.app.events.create',
            compact('cities', 'organizers', 'formatMixes', 'topicMixes')
        );
    }

    /**
     * @param \App\Http\Requests\Admin\EventStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventStoreRequest $request)
    {
        $this->authorize('create', Event::class);

        $validated = $request->validated();
        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('public');
        }

        $event = Event::create($validated);

        return redirect()
            ->route('events.edit', $event)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Event $event)
    {
        $this->authorize('view', $event);

        return view('admin.app.events.show', compact('event'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $cities = City::pluck('city_name', 'id');
        $organizers = Organizer::pluck('name', 'id');
        $formatMixes = FormatMix::pluck('format', 'id');
        $topicMixes = TopicMix::pluck('topic', 'id');

        return view(
            'admin.app.events.edit',
            compact(
                'event',
                'cities',
                'organizers',
                'formatMixes',
                'topicMixes'
            )
        );
    }

    /**
     * @param \App\Http\Requests\Admin\EventUpdateRequest $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventUpdateRequest $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validated();
        if ($request->hasFile('banner')) {
            if ($event->banner) {
                Storage::delete($event->banner);
            }

            $validated['banner'] = $request->file('banner')->store('public');
        }

        $event->update($validated);

        return redirect()
            ->route('events.edit', $event)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Event $event)
    {
        $this->authorize('delete', $event);

        if ($event->banner) {
            Storage::delete($event->banner);
        }

        $event->delete();

        return redirect()
            ->route('events.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
