<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Format;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FormatResource;
use App\Http\Resources\FormatCollection;
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

        $search = $request->get('search', '');

        $formats = Format::search($search)
            ->latest()
            ->paginate();

        return new FormatCollection($formats);
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

        return new FormatResource($format);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Format $format
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Format $format)
    {
        $this->authorize('view', $format);

        return new FormatResource($format);
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

        return new FormatResource($format);
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

        return response()->noContent();
    }
}
