<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactCollection;
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

        $search = $request->get('search', '');

        $contacts = Contact::search($search)
            ->latest()
            ->paginate();

        return new ContactCollection($contacts);
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

        return new ContactResource($contact);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Contact $contact)
    {
        $this->authorize('view', $contact);

        return new ContactResource($contact);
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

        return new ContactResource($contact);
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

        return response()->noContent();
    }
}
