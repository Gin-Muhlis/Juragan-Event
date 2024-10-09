<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Juragan;
use App\Models\Organizer;
use Artesaos\SEOTools\Facades\SEOTools;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class OrganizerController extends Controller
{
    public function show(Request $request)
    {
        $nameRequest = $request->route('name');
        $words = explode('-', $nameRequest);
        $name = implode(' ', $words);

        $organizer = Organizer::with('events')->where('name', $name)->first();

        SEOTools::setTitle($organizer->name);
        SEOTools::setDescription('Salah satu penyelenggara event yang telah berpartisipasi dalam penyelenggaran event di Juragan Event.');
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@juraganevent1');

        $organizer = Organizer::with('events')->where('name', $name)->first();
        $activeEvents = [];
        $pastEvents = [];

        $now = Carbon::now();

        $data = Juragan::latest()->first();

        foreach ($organizer->events as $event) {
            if ($event->start_at < $now) {
                $pastEvents[] = [
                    'slug' => $event->slug,
                    'banner' => $event->banner,
                    'title' => $event->title,
                    'date' => $this->generateDate($event->start_at, $event->end_at),
                    'tickets' => $event->tickets,
                ];
            } else {
                $activeEvents[] = [
                    'slug' => $event->slug,
                    'banner' => $event->banner,
                    'title' => $event->title,
                    'date' => $this->generateDate($event->start_at, $event->end_at),
                    'tickets' => $event->tickets,
                ];
            }
        }

        return view('user.details.detailprofile', [
            'tittle' => 'Organizer',
            'activeEvents' => $activeEvents,
            'pastEvents' => $pastEvents,
            'organizer' => $organizer,
            'data' => $data
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


        $date = $dateStartParts[2] . ($dateStartParts[1] !== $dateEndParts[1] ? $bulan[$dateStartParts[1]] : '') . ($dateStartParts[1] !== $dateEndParts[1] ? ' - ' . $dateEndParts[2] : '') . ' ' . $bulan[$dateEndParts[1]] . ' ' . $dateEndParts[0];
        return $date;
    }
}
