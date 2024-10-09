<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\TopicMix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\PostStoreRequest;
use App\Http\Requests\Admin\PostUpdateRequest;

class PostController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Post::class);

        $posts = Post::get();

        return view('admin.app.posts.index', compact('posts'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Post::class);

        $users = User::pluck('name', 'id');
        $topicMixes = TopicMix::pluck('topic', 'id');

        return view('admin.app.posts.create', compact('users', 'topicMixes'));
    }

    /**
     * @param \App\Http\Requests\Admin\PostStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $post = Post::create($validated);

        return redirect()
            ->route('posts.edit', $post)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Post $post)
    {
        $this->authorize('view', $post);

        return view('admin.app.posts.show', compact('post'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $users = User::pluck('name', 'id');
        $topicMixes = TopicMix::pluck('topic', 'id');

        return view(
            'admin.app.posts.edit',
            compact('post', 'users', 'topicMixes')
        );
    }

    /**
     * @param \App\Http\Requests\Admin\PostUpdateRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete($post->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $post->update($validated);

        return redirect()
            ->route('posts.edit', $post)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        $this->authorize('delete', $post);

        if ($post->image) {
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
