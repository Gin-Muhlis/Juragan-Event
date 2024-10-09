<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\ContactSendRequest;
use App\Models\Contact;
use App\Models\Juragan;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\URL;

class ContactController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Hubungi Kami');
        SEOTools::setDescription('Sampaikan pesan anda kepada kami dan akan kami tanggapi dengan senang hati apa yang telah anda sampaikan.');
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@juraganevent1');

        $dataContact = Juragan::latest()->first();

        return view('user.hubungiKami', [
            'tittle' => 'Hubungi Kami',
            'data' => $dataContact
        ]);
    }

    public function send(ContactSendRequest $request)
    {
        $validated = $request->validated();

        Contact::create($validated);

        return response()->json(['message' => 'Pesan berhasil terkirim!']);
    }
}
