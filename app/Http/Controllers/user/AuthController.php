<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Juragan;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function daftar()
    {
        SEOTools::setTitle('Daftar');
        SEOTools::setDescription('Ayok bergabung dengan Juragan Event dan ikuti event-event menarik, keren, dan populer yang telah disediakan Juragan Event.');
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@juraganevent1');

        $data = Juragan::latest()->first();
        return view('user.auth.daftar', compact('data'));
    }

    public function login()
    {
        SEOTools::setTitle('Masuk');
        SEOTools::setDescription('Ayok bergabung dengan Juragan Event dan ikuti event-event menarik, keren, dan populer yang telah disediakan Juragan Event.');
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@juraganevent1');
        $data = Juragan::latest()->first();

        return view('user.auth.login', compact('data'));
    }
}
