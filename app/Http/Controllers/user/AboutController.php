<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Juragan;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\URL;

class AboutController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Tentang');
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@juraganevent1');

        $dataAbout = Juragan::latest()->first();

        return view('user.tentang', [
            'tittle' => 'Tentang',
            'data' => $dataAbout
        ]);
    }
}
