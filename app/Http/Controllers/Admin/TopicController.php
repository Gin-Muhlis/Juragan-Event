<?php

namespace App\Http\Controllers\Admin;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TopicStoreRequest;
use App\Http\Requests\Admin\TopicUpdateRequest;

class TopicController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Topic::class);

        $search = $request->get('search', '');

        $topics = Topic::get();

        return view('admin.app.topics.index', compact('topics'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Topic::class);

        return view('admin.app.topics.create');
    }

    /**
     * @param \App\Http\Requests\Admin\TopicStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicStoreRequest $request)
    {
        $this->authorize('create', Topic::class);

        $validated = $request->validated();

        $topic = Topic::create($validated);

        return redirect()
            ->route('topics.edit', $topic)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Topic $topic)
    {
        $this->authorize('view', $topic);

        return view('admin.app.topics.show', compact('topic'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        return view('admin.app.topics.edit', compact('topic'));
    }

    /**
     * @param \App\Http\Requests\Admin\TopicUpdateRequest $request
     * @param \App\Models\Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function update(TopicUpdateRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $validated = $request->validated();

        $topic->update($validated);

        return redirect()
            ->route('topics.edit', $topic)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Topic $topic)
    {
        $this->authorize('delete', $topic);

        $topic->delete();

        return redirect()
            ->route('topics.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
