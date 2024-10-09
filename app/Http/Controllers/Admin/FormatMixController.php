<?php

namespace App\Http\Controllers\Admin;

use App\Models\FormatMix;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FormatMixStoreRequest;
use App\Http\Requests\Admin\FormatMixUpdateRequest;
use App\Models\Format;

class FormatMixController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', FormatMix::class);

        $formatMixes = FormatMix::get();

        return view(
            'admin.app.format_mixes.index',
            compact('formatMixes')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', FormatMix::class);

        $formats = Format::get();

        return view('admin.app.format_mixes.create', compact('formats'));
    }

    /**
     * @param \App\Http\Requests\Admin\FormatMixStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormatMixStoreRequest $request)
    {
        $this->authorize('create', FormatMix::class);

        $validated = $request->validated();

        $formatMix = FormatMix::create($validated);

        return redirect()
            ->route('format-mixes.edit', $formatMix)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FormatMix $formatMix
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, FormatMix $formatMix)
    {
        $this->authorize('view', $formatMix);

        return view('admin.app.format_mixes.show', compact('formatMix'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FormatMix $formatMix
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, FormatMix $formatMix)
    {
        $this->authorize('update', $formatMix);

        $formats = Format::get();

        return view('admin.app.format_mixes.edit', compact('formatMix', 'formats'));
    }

    /**
     * @param \App\Http\Requests\Admin\FormatMixUpdateRequest $request
     * @param \App\Models\FormatMix $formatMix
     * @return \Illuminate\Http\Response
     */
    public function update(
        FormatMixUpdateRequest $request,
        FormatMix $formatMix
    ) {
        $this->authorize('update', $formatMix);

        $validated = $request->validated();

        $formatMix->update($validated);

        return redirect()
            ->route('format-mixes.edit', $formatMix)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FormatMix $formatMix
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, FormatMix $formatMix)
    {
        $this->authorize('delete', $formatMix);

        $formatMix->delete();

        return redirect()
            ->route('format-mixes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
