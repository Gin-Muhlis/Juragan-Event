<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class GaleryController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Galeri');
        SEOTools::setDescription('Galeri dari kenangan-kenangan yang didapat dari event-event yang pernah disediakan di Juragan Event.');
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@juraganevent1');

        $dataGaleries = Galery::limit(6)->latest()->get();
        return view('user.galeri', [
            'tittle' => 'Galeri',
            'galeries' => $dataGaleries
        ]);
    }

    public function moreImage(Request $request)
    {
        $limit = $request->input('limit');

        $images = Galery::limit($limit)->latest()->get();
        $result = [];

        foreach ($images as $image) {
            $words = explode(' ', $image->description);
            $result[] = [
                'image' => Storage::url($image->image),
                'caption' => $image->caption,
                'description' => implode(' ', array_slice($words, 0, 15)) . (count($words) > 15 ? '...' : '')
            ];
        }

        return response()->json($result);
    }
}
