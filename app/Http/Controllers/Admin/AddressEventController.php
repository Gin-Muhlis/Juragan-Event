<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\AddressEvent;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AddressEventStoreRequest;
use App\Http\Requests\Admin\AddressEventUpdateRequest;

class AddressEventController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', AddressEvent::class);

        $addressEvents = AddressEvent::get();

        return view(
            'admin.app.address_events.index',
            compact('addressEvents')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', AddressEvent::class);

        $events = Event::pluck('title', 'id');

        return view('admin.app.address_events.create', compact('events'));
    }

    /**
     * @param \App\Http\Requests\Admin\AddressEventStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressEventStoreRequest $request)
    {
        $this->authorize('create', AddressEvent::class);

        $validated = $request->validated();

        $addressEvent = AddressEvent::create($validated);

        return redirect()
            ->route('address-events.edit', $addressEvent)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AddressEvent $addressEvent
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AddressEvent $addressEvent)
    {
        $this->authorize('view', $addressEvent);

        return view('admin.app.address_events.show', compact('addressEvent'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AddressEvent $addressEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, AddressEvent $addressEvent)
    {
        $this->authorize('update', $addressEvent);

        $events = Event::pluck('title', 'id');

        return view(
            'admin.app.address_events.edit',
            compact('addressEvent', 'events')
        );
    }

    /**
     * @param \App\Http\Requests\Admin\AddressEventUpdateRequest $request
     * @param \App\Models\AddressEvent $addressEvent
     * @return \Illuminate\Http\Response
     */
    public function update(
        AddressEventUpdateRequest $request,
        AddressEvent $addressEvent
    ) {
        $this->authorize('update', $addressEvent);

        $validated = $request->validated();

        $addressEvent->update($validated);

        return redirect()
            ->route('address-events.edit', $addressEvent)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AddressEvent $addressEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, AddressEvent $addressEvent)
    {
        $this->authorize('delete', $addressEvent);

        $addressEvent->delete();

        return redirect()
            ->route('address-events.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
