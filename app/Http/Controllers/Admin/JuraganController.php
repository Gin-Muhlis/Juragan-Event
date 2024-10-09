<?php

namespace App\Http\Controllers\Admin;

use App\Models\Juragan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\JuraganStoreRequest;
use App\Http\Requests\Admin\JuraganUpdateRequest;

class JuraganController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Juragan::class);

        $juragans = Juragan::get();

        return view('admin.app.juragans.index', compact('juragans'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Juragan::class);

        return view('admin.app.juragans.create');
    }

    /**
     * @param \App\Http\Requests\Admin\JuraganStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JuraganStoreRequest $request)
    {
        $this->authorize('create', Juragan::class);

        $validated = $request->validated();
        if ($request->hasFile('banner_website')) {
            $validated['banner_website'] = $request
                ->file('banner_website')
                ->store('public');
        }

        if ($request->hasFile('logo_website')) {
            $validated['logo_website'] = $request
                ->file('logo_website')
                ->store('public');
        }

        $juragan = Juragan::create($validated);

        return redirect()
            ->route('juragans.edit', $juragan)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Juragan $juragan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Juragan $juragan)
    {
        $this->authorize('view', $juragan);

        return view('admin.app.juragans.show', compact('juragan'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Juragan $juragan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Juragan $juragan)
    {
        $this->authorize('update', $juragan);

        return view('admin.app.juragans.edit', compact('juragan'));
    }

    /**
     * @param \App\Http\Requests\Admin\JuraganUpdateRequest $request
     * @param \App\Models\Juragan $juragan
     * @return \Illuminate\Http\Response
     */
    public function update(JuraganUpdateRequest $request, Juragan $juragan)
    {
        $this->authorize('update', $juragan);

        $validated = $request->validated();
        if ($request->hasFile('banner_website')) {
            if ($juragan->banner_website) {
                Storage::delete($juragan->banner_website);
            }

            $validated['banner_website'] = $request
                ->file('banner_website')
                ->store('public');
        }
        if ($request->hasFile('logo_website')) {
            if ($juragan->logo_website) {
                Storage::delete($juragan->logo_website);
            }

            $validated['logo_website'] = $request
                ->file('logo_website')
                ->store('public');
        }

        $juragan->update($validated);

        return redirect()
            ->route('juragans.edit', $juragan)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Juragan $juragan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Juragan $juragan)
    {
        $this->authorize('delete', $juragan);

        if ($juragan->banner_website) {
            Storage::delete($juragan->banner_website);
        }

        $juragan->delete();

        return redirect()
            ->route('juragans.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
