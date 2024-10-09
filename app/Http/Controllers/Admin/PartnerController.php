<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\PartnerStoreRequest;
use App\Http\Requests\Admin\PartnerUpdateRequest;

class PartnerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Partner::class);

        $partners = Partner::get();

        return view('admin.app.partners.index', compact('partners'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Partner::class);

        return view('admin.app.partners.create');
    }

    /**
     * @param \App\Http\Requests\Admin\PartnerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerStoreRequest $request)
    {
        $this->authorize('create', Partner::class);

        $validated = $request->validated();

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('public');
        }

        $partner = Partner::create($validated);

        return redirect()
            ->route('partners.edit', $partner)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Partner $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Partner $partner)
    {
        $this->authorize('view', $partner);

        return view('admin.app.partners.show', compact('partner'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Partner $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Partner $partner)
    {
        $this->authorize('update', $partner);

        return view('admin.app.partners.edit', compact('partner'));
    }

    /**
     * @param \App\Http\Requests\Admin\PartnerUpdateRequest $request
     * @param \App\Models\Partner $partner
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerUpdateRequest $request, Partner $partner)
    {
        $this->authorize('update', $partner);

        $validated = $request->validated();

        if ($request->file('icon')) {
            if ($partner->icon) {
                Storage::delete($partner->icon);
            }
            $validated['icon'] = $request->file('icon')->store('public');
        }

        $partner->update($validated);

        return redirect()
            ->route('partners.edit', $partner)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Partner $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Partner $partner)
    {
        $this->authorize('delete', $partner);

        $partner->delete();

        return redirect()
            ->route('partners.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
