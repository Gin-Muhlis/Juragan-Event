<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Juragan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JuraganResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\JuraganCollection;
use App\Http\Requests\Admin\JuraganStoreRequest;
use App\Http\Requests\Admin\JuraganUpdateRequest;

class JuraganController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Juragan::class);

        $search = $request->get('search', '');

        $juragans = Juragan::search($search)
            ->latest()
            ->paginate();

        return new JuraganCollection($juragans);
    }

    /**
     * @param \App\Http\Requests\Admin\JuraganStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(JuraganStoreRequest $request)
    {
        $this->authorize('create', Juragan::class);

        $validated = $request->validated();
        if ($request->hasFile('banner_website')) {
            $validated['banner_website'] = $request
                ->file('banner_website')
                ->store('public');
        }

        $juragan = Juragan::create($validated);

        return new JuraganResource($juragan);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Juragan $juragan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Juragan $juragan)
    {
        $this->authorize('view', $juragan);

        return new JuraganResource($juragan);
    }

    /**
     * @param \App\Http\Requests\Admin\JuraganUpdateRequest $request
     * @param \App\Models\Juragan $juragan
     * @return \Illuminate\Http\Response
     */
    public function update(JuraganUpdateRequest $request, Juragan $juragan)
    {
        $this->authorize('update', $juragan);

        $validated = $request->validated();

        if ($request->hasFile('banner_website')) {
            if ($juragan->banner_website) {
                Storage::delete($juragan->banner_website);
            }

            $validated['banner_website'] = $request
                ->file('banner_website')
                ->store('public');
        }

        $juragan->update($validated);

        return new JuraganResource($juragan);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Juragan $juragan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Juragan $juragan)
    {
        $this->authorize('delete', $juragan);

        if ($juragan->banner_website) {
            Storage::delete($juragan->banner_website);
        }

        $juragan->delete();

        return response()->noContent();
    }
}
