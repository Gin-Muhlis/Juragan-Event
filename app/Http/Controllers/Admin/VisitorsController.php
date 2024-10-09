<?php

namespace App\Http\Controllers\Admin;

use App\Models\Visitors;
use Illuminate\Http\Request;
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

        $allVisitors = Visitors::get();

        return view(
            'admin.app.all_visitors.index',
            compact('allVisitors', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Visitors::class);

        return view('admin.app.all_visitors.create');
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

        return redirect()
            ->route('all-visitors.edit', $visitors)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Visitors $visitors
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Visitors $visitors)
    {
        $this->authorize('view', $visitors);

        return view('admin.app.all_visitors.show', compact('visitors'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Visitors $visitors
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Visitors $visitors)
    {
        $this->authorize('update', $visitors);

        return view('admin.app.all_visitors.edit', compact('visitors'));
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

        return redirect()
            ->route('all-visitors.edit', $visitors)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('all-visitors.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
