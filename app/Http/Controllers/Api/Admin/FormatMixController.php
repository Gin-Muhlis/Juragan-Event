<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\FormatMix;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FormatMixResource;
use App\Http\Resources\FormatMixCollection;
use App\Http\Requests\Admin\FormatMixStoreRequest;
use App\Http\Requests\Admin\FormatMixUpdateRequest;

class FormatMixController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', FormatMix::class);

        $search = $request->get('search', '');

        $formatMixes = FormatMix::search($search)
            ->latest()
            ->paginate();

        return new FormatMixCollection($formatMixes);
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

        return new FormatMixResource($formatMix);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FormatMix $formatMix
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, FormatMix $formatMix)
    {
        $this->authorize('view', $formatMix);

        return new FormatMixResource($formatMix);
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

        return new FormatMixResource($formatMix);
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

        return response()->noContent();
    }
}
