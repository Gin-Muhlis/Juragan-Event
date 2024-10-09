<?php

namespace App\Http\Controllers\Admin;

use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\OrganizerStoreRequest;
use App\Http\Requests\Admin\OrganizerUpdateRequest;

class OrganizerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Organizer::class);

        $organizers = Organizer::get();

        return view(
            'admin.app.organizers.index',
            compact('organizers')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Organizer::class);

        return view('admin.app.organizers.create');
    }

    /**
     * @param \App\Http\Requests\Admin\OrganizerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizerStoreRequest $request)
    {
        $this->authorize('create', Organizer::class);

        $validated = $request->validated();
        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('public');
        }

        $organizer = Organizer::create($validated);

        return redirect()
            ->route('organizers.edit', $organizer)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organizer $organizer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Organizer $organizer)
    {
        $this->authorize('view', $organizer);

        return view('admin.app.organizers.show', compact('organizer'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organizer $organizer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Organizer $organizer)
    {
        $this->authorize('update', $organizer);

        return view('admin.app.organizers.edit', compact('organizer'));
    }

    /**
     * @param \App\Http\Requests\Admin\OrganizerUpdateRequest $request
     * @param \App\Models\Organizer $organizer
     * @return \Illuminate\Http\Response
     */
    public function update(
        OrganizerUpdateRequest $request,
        Organizer $organizer
    ) {
        $this->authorize('update', $organizer);

        $validated = $request->validated();
        if ($request->hasFile('icon')) {
            if ($organizer->icon) {
                Storage::delete($organizer->icon);
            }

            $validated['icon'] = $request->file('icon')->store('public');
        }

        $organizer->update($validated);

        return redirect()
            ->route('organizers.edit', $organizer)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organizer $organizer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Organizer $organizer)
    {
        $this->authorize('delete', $organizer);

        if ($organizer->icon) {
            Storage::delete($organizer->icon);
        }

        $organizer->delete();

        return redirect()
            ->route('organizers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
