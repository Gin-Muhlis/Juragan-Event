<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\FormatMix;
use App\Models\Partner;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        SEOTools::setTitle('Beranda');
        SEOTools::setDescription('Platform terkemuka untuk pembelian tiket, pembuatan event, dan informasi terkini seputar berita mengenai Juragan Event dan berita di Provinsi Jawa Barat.');
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@juraganevent1');

        $carouselEvent = Event::limit(3)->latest()->get();
        $partners = Partner::get();

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weekEvents = Event::with(['tickets', 'organizer'])->whereBetween('start_at', [$startOfWeek, $endOfWeek])->get();
        $resultWeekEvents = [];



        foreach ($weekEvents as $event) {
            $resultWeekEvents[] = [
                'identifier' => $event->identifier,
                'banner' => $event->banner,
                'title' => $event->title,
                'slug' => $event->slug,
                'organizer' => $event->organizer->name,
                'date' => $this->generateDate($event->created_at, $event->end_at),
                'icon_organizer' => $event->organizer->icon,
                'tickets' => $event->tickets,

            ];
        }

        $choicedCategory = FormatMix::withCount('events')
            ->orderByDesc('events_count')
            ->limit(4)
            ->get();

        $categoryId = $request->query('category');
        $idFormats = [];

        foreach ($choicedCategory as $category) {
            $idFormats[] = $category->id;
        }

        if (!is_null($categoryId)) {
            $eventCategories = Event::where('format_mix_id', $categoryId)->get();
        } else {
            $eventCategories = Event::whereIn('format_mix_id', $idFormats)->get();
        }

        $posts = Post::latest()->limit(6)->latest()->get();

        return view('welcome', [
            'tittle' => 'Home',
            'carouselEvent' => $carouselEvent,
            'partners' => $partners,
            'weekEvents' => $resultWeekEvents,
            'eventCategories' => $eventCategories,
            'posts' => $posts,
            'choicedCategory' => $choicedCategory
        ]);
    }

    public function generateDate($startDate, $endDate)
    {
        $formatStartDate = $startDate->format('Y-m-d');
        $dateStartParts = explode('-', $formatStartDate);

        $formatEndDate = $endDate->format('Y-m-d');
        $dateEndParts = explode('-', $formatEndDate);

        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];



        $date = $dateStartParts[2] . ' ' . ($dateStartParts[1] !== $dateEndParts[1] ? $bulan[$dateStartParts[1]] : '') . ($dateStartParts[1] !== $dateEndParts[1] ? ' - ' . $dateEndParts[2] : '') . ' ' . $bulan[$dateEndParts[1]] . ' ' . $dateEndParts[0];

        return $date;
    }
}
