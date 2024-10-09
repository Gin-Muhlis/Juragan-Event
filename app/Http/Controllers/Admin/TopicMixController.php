<?php

namespace App\Http\Controllers\Admin;

use App\Models\TopicMix;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TopicMixStoreRequest;
use App\Http\Requests\Admin\TopicMixUpdateRequest;
use App\Models\Topic;

class TopicMixController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', TopicMix::class);

        $topicMixes = TopicMix::get();

        return view(
            'admin.app.topic_mixes.index',
            compact('topicMixes')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', TopicMix::class);

        $topics = Topic::get();

        return view('admin.app.topic_mixes.create', compact('topics'));
    }

    /**
     * @param \App\Http\Requests\Admin\TopicMixStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicMixStoreRequest $request)
    {
        $this->authorize('create', TopicMix::class);

        $validated = $request->validated();

        $topicMix = TopicMix::create($validated);

        return redirect()
            ->route('topic-mixes.edit', $topicMix)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TopicMix $topicMix
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TopicMix $topicMix)
    {
        $this->authorize('view', $topicMix);

        return view('admin.app.topic_mixes.show', compact('topicMix'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TopicMix $topicMix
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, TopicMix $topicMix)
    {
        $this->authorize('update', $topicMix);

        $topics = Topic::get();


        return view('admin.app.topic_mixes.edit', compact('topicMix', 'topics'));
    }

    /**
     * @param \App\Http\Requests\Admin\TopicMixUpdateRequest $request
     * @param \App\Models\TopicMix $topicMix
     * @return \Illuminate\Http\Response
     */
    public function update(TopicMixUpdateRequest $request, TopicMix $topicMix)
    {
        $this->authorize('update', $topicMix);

        $validated = $request->validated();

        $topicMix->update($validated);

        return redirect()
            ->route('topic-mixes.edit', $topicMix)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TopicMix $topicMix
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TopicMix $topicMix)
    {
        $this->authorize('delete', $topicMix);

        $topicMix->delete();

        return redirect()
            ->route('topic-mixes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
