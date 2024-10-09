<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CityStoreRequest;
use App\Http\Requests\Admin\CityUpdateRequest;

class CityController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', City::class);

        $cities = City::get();

        return view('admin.app.cities.index', compact('cities'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', City::class);

        return view('admin.app.cities.create');
    }

    /**
     * @param \App\Http\Requests\Admin\CityStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityStoreRequest $request)
    {
        $this->authorize('create', City::class);

        $validated = $request->validated();

        $city = City::create($validated);

        return redirect()
            ->route('cities.edit', $city)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, City $city)
    {
        $this->authorize('view', $city);

        return view('admin.app.cities.show', compact('city'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, City $city)
    {
        $this->authorize('update', $city);

        return view('admin.app.cities.edit', compact('city'));
    }

    /**
     * @param \App\Http\Requests\Admin\CityUpdateRequest $request
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityUpdateRequest $request, City $city)
    {
        $this->authorize('update', $city);

        $validated = $request->validated();

        $city->update($validated);

        return redirect()
            ->route('cities.edit', $city)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, City $city)
    {
        $this->authorize('delete', $city);

        $city->delete();

        return redirect()
            ->route('cities.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
