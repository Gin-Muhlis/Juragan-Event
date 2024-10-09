<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\TopicMix;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;

class TopicMixPostsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TopicMix $topicMix
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TopicMix $topicMix)
    {
        $this->authorize('view', $topicMix);

        $search = $request->get('search', '');

        $posts = $topicMix
            ->posts()
            ->search($search)
            ->latest()
            ->paginate();

        return new PostCollection($posts);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TopicMix $topicMix
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TopicMix $topicMix)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'content' => ['required', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $post = $topicMix->posts()->create($validated);

        return new PostResource($post);
    }
}
