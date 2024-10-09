<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Visitors;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VisitorsResource;
use App\Http\Resources\VisitorsCollection;
use App\Http\Requests\Admin\VisitorsStoreRequest;
use App\Http\Requests\Admin\VisitorsUpdateRequest;

class VisitorsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Visitors::class);

        $search = $request->get('search', '');

        $allVisitors = Visitors::search($search)
            ->latest()
            ->paginate();

        return new VisitorsCollection($allVisitors);
    }

    /**
     * @param \App\Http\Requests\Admin\VisitorsStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitorsStoreRequest $request)
    {
        $this->authorize('create', Visitors::class);

        $validated = $request->validated();

        $visitors = Visitors::create($validated);

        return new VisitorsResource($visitors);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Visitors $visitors
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Visitors $visitors)
    {
        $this->authorize('view', $visitors);

        return new VisitorsResource($visitors);
    }

    /**
     * @param \App\Http\Requests\Admin\VisitorsUpdateRequest $request
     * @param \App\Models\Visitors $visitors
     * @return \Illuminate\Http\Response
     */
    public function update(VisitorsUpdateRequest $request, Visitors $visitors)
    {
        $this->authorize('update', $visitors);

        $validated = $request->validated();

        $visitors->update($validated);

        return new VisitorsResource($visitors);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Visitors $visitors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Visitors $visitors)
    {
        $this->authorize('delete', $visitors);

        $visitors->delete();

        return response()->noContent();
    }
}
