<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ContactStoreRequest;
use App\Http\Requests\Admin\ContactUpdateRequest;

class ContactController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Contact::class);

        $contacts = Contact::get();

        return view('admin.app.contacts.index', compact('contacts'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Contact::class);

        return view('admin.app.contacts.create');
    }

    /**
     * @param \App\Http\Requests\Admin\ContactStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        $this->authorize('create', Contact::class);

        $validated = $request->validated();

        $contact = Contact::create($validated);

        return redirect()
            ->route('contacts.edit', $contact)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Contact $contact)
    {
        $this->authorize('view', $contact);

        return view('admin.app.contacts.show', compact('contact'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        return view('admin.app.contacts.edit', compact('contact'));
    }

    /**
     * @param \App\Http\Requests\Admin\ContactUpdateRequest $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        $validated = $request->validated();

        $contact->update($validated);

        return redirect()
            ->route('contacts.edit', $contact)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Contact $contact)
    {
        $this->authorize('delete', $contact);

        $contact->delete();

        return redirect()
            ->route('contacts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
