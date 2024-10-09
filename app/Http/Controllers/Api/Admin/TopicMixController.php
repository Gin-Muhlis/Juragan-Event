<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\TopicMix;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TopicMixResource;
use App\Http\Resources\TopicMixCollection;
use App\Http\Requests\Admin\TopicMixStoreRequest;
use App\Http\Requests\Admin\TopicMixUpdateRequest;

class TopicMixController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', TopicMix::class);

        $search = $request->get('search', '');

        $topicMixes = TopicMix::search($search)
            ->latest()
            ->paginate();

        return new TopicMixCollection($topicMixes);
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

        return new TopicMixResource($topicMix);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TopicMix $topicMix
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TopicMix $topicMix)
    {
        $this->authorize('view', $topicMix);

        return new TopicMixResource($topicMix);
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

        return new TopicMixResource($topicMix);
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

        return response()->noContent();
    }
}
