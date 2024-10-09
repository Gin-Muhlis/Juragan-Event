<?php

namespace App\Http\Controllers\Admin;

use App\Models\Format;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FormatStoreRequest;
use App\Http\Requests\Admin\FormatUpdateRequest;

class FormatController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Format::class);

        $formats = Format::get();

        return view('admin.app.formats.index', compact('formats'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Format::class);

        return view('admin.app.formats.create');
    }

    /**
     * @param \App\Http\Requests\Admin\FormatStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormatStoreRequest $request)
    {
        $this->authorize('create', Format::class);

        $validated = $request->validated();

        $format = Format::create($validated);

        return redirect()
            ->route('formats.edit', $format)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Format $format
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Format $format)
    {
        $this->authorize('view', $format);

        return view('admin.app.formats.show', compact('format'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Format $format
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Format $format)
    {
        $this->authorize('update', $format);

        return view('admin.app.formats.edit', compact('format'));
    }

    /**
     * @param \App\Http\Requests\Admin\FormatUpdateRequest $request
     * @param \App\Models\Format $format
     * @return \Illuminate\Http\Response
     */
    public function update(FormatUpdateRequest $request, Format $format)
    {
        $this->authorize('update', $format);

        $validated = $request->validated();

        $format->update($validated);

        return redirect()
            ->route('formats.edit', $format)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Format $format
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Format $format)
    {
        $this->authorize('delete', $format);

        $format->delete();

        return redirect()
            ->route('formats.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
