<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Galery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GaleryResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\GaleryCollection;
use App\Http\Requests\Admin\GaleryStoreRequest;
use App\Http\Requests\Admin\GaleryUpdateRequest;

class GaleryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Galery::class);

        $search = $request->get('search', '');

        $galeries = Galery::search($search)
            ->latest()
            ->paginate();

        return new GaleryCollection($galeries);
    }

    /**
     * @param \App\Http\Requests\Admin\GaleryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GaleryStoreRequest $request)
    {
        $this->authorize('create', Galery::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $galery = Galery::create($validated);

        return new GaleryResource($galery);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Galery $galery
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Galery $galery)
    {
        $this->authorize('view', $galery);

        return new GaleryResource($galery);
    }

    /**
     * @param \App\Http\Requests\Admin\GaleryUpdateRequest $request
     * @param \App\Models\Galery $galery
     * @return \Illuminate\Http\Response
     */
    public function update(GaleryUpdateRequest $request, Galery $galery)
    {
        $this->authorize('update', $galery);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($galery->image) {
                Storage::delete($galery->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $galery->update($validated);

        return new GaleryResource($galery);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Galery $galery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Galery $galery)
    {
        $this->authorize('delete', $galery);

        if ($galery->image) {
            Storage::delete($galery->image);
        }

        $galery->delete();

        return response()->noContent();
    }
}
