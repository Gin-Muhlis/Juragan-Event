<?php

namespace App\Http\Controllers\Admin;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        $galeries = Galery::get();

        return view('admin.app.galeries.index', compact('galeries'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Galery::class);

        return view('admin.app.galeries.create');
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

        return redirect()
            ->route('galeries.edit', $galery)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Galery $galery
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Galery $galery)
    {
        $this->authorize('view', $galery);

        return view('admin.app.galeries.show', compact('galery'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Galery $galery
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Galery $galery)
    {
        $this->authorize('update', $galery);

        return view('admin.app.galeries.edit', compact('galery'));
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

        return redirect()
            ->route('galeries.edit', $galery)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('galeries.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
