<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Event;
use App\Models\FormatMix;
use App\Models\TopicMix;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class EventController extends Controller
{
    public function index(Request $request)
    {
        SEOTools::setTitle('Event');
        SEOTools::setDescription('Temukan berbagai event yang tersedia di Jawa Barat yang telah disediakan oleh Juragan Event dengan kategori yang menarik.');
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@juraganevent1');

        $cities = City::get();
        $formats = FormatMix::get();
        $topics = TopicMix::get();

        $filterCity = $request->filled('filterCity') ? $request->input('filterCity') : null;
        $filterFormat = $request->filled('filterFormat') ? $request->input('filterFormat') : null;
        $filterTopic = $request->filled('filterTopic') ? $request->input('filterTopic') : null;
        $filterTime = $request->filled('filterTime') ? $request->input('filterTime') : null;
        $filterTypeTicket = $request->filled('filterType') ? $request->input('filterType') : null;

        $now = Carbon::now();
        $startOfWeek = $now->copy()->startOfWeek();
        $endOfWeek = $now->copy()->endOfWeek();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        $startNextMonth = $now->copy()->startOfMonth()->addMonth();
        $endNextMonth = $now->copy()->endOfMonth()->addMonth();

        $search = $request->input('keyword');

        $events = Event::with(['organizer', 'tickets'])
            ->search($search)
            ->when($filterTypeTicket, function ($query) use ($filterTypeTicket) {
                $query->whereHas('tickets', function ($query) use ($filterTypeTicket) {
                    $query->where('type', $filterTypeTicket);
                });
            })
            ->when($filterCity, function ($query) use ($filterCity) {
                $query->where('city_id', $filterCity);
            })
            ->when($filterFormat, function ($query) use ($filterFormat) {
                $query->where('format_mix_id', $filterFormat);
            })
            ->when($filterTopic, function ($query) use ($filterTopic) {
                $query->where('topic_mix_id', $filterTopic);
            })
            ->when($filterTime, function ($query) use ($filterTime, $startOfWeek, $endOfWeek, $startOfMonth, $endOfMonth, $startNextMonth, $endNextMonth) {
                switch ($filterTime) {
                    case 'minggu ini':
                        $query->whereBetween('start_at', [$startOfWeek, $endOfWeek]);
                        break;
                    case 'bulan ini':
                        $query->whereBetween('start_at', [$startOfMonth, $endOfMonth]);
                        break;
                    case 'bulan depan':
                        $query->whereBetween('start_at', [$startNextMonth, $endNextMonth]);
                        break;
                }
            })
            ->paginate(6)
            ->withQueryString();

        $valueFilterCity = $filterCity ? City::select('city_name')->find($filterCity) : null;
        $valueFilterFormat = $filterFormat ? FormatMix::select('format')->find($filterFormat) : null;
        $valueFilterTopic = $filterTopic ? TopicMix::select('topic')->find($filterTopic) : null;
            
        return view('user.event', [
            'tittle' => 'Event',
            'events' => $events,
            'cities' => $cities,
            'formats' => $formats,
            'topics' => $topics,
            'filterCity' => $filterCity,
            'filterFormat' => $filterFormat,
            'filterTopic' => $filterTopic,
            'filterTime' => $filterTime,
            'filterType' => $filterTypeTicket,
            'valueFilterCity' => $valueFilterCity,
            'valueFilterFormat' => $valueFilterFormat,
            'valueFilterTopic' => $valueFilterTopic,
        ]);
    }

    public function show(Request $request, $slug)
    {

        $event = Event::with(['addressEvents', 'organizer', 'tickets'])->where('slug', $slug)->first();
        $description = explode(' ', strip_tags($event->description));


        SEOTools::setTitle($event->title);
        SEOTools::setDescription(implode(' ', array_slice($description, 0, 25)));
        SEOTools::opengraph()->setUrl(URL::current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@juraganevent1');

        $dateEvent = $this->generateDate($event->start_at, $event->end_at);
        $timeEvent = $this->generateTime($event->start_at, $event->end_at);

        $relatedEvents = Event::with(['organizer', 'tickets'])->where('format_mix_id', $event->format_mix_id)->where('id', '!=', $event->id)->get();

        $dataTickets = [];

        foreach ($event->tickets as $ticket) {
            $hargaAwal = $ticket->price;
            $discount = ($hargaAwal * $ticket->discount) / 100;

            $hargaDiscount = $hargaAwal - $discount;

            $fee_admin = ($hargaDiscount * $ticket->fee_admin) / 100;
            $tax_coast = ($hargaDiscount * $ticket->tax_coast) / 100;

            $hargaAkhir = $hargaDiscount + $fee_admin + $tax_coast;
            $ticket = [
                'id_ticket' => $ticket->id,
                'name_ticket' => $ticket->name,
                'quota_ticket' => $ticket->quota,
                'price_ticket' => $hargaAkhir,
                'quantity_ticket' => 0
            ];

            $dataTickets[] = $ticket;
        }

        return view('user.details.deskripsiEVent', [
            'tittle' => 'Detail Event',
            'event' => $event,
            'date_event' => $dateEvent,
            'time_event' => $timeEvent,
            'related_events' => $relatedEvents,
            'dataTickets' => $dataTickets,
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

    public function generateTime($startTime, $endTime)
    {
        $formatStartTime = $startTime->format('H:i:s');
        $timeStartParts = explode(':', $formatStartTime);

        $formatEndTime = $endTime->format('H:i:s');
        $timeEndParts = explode(':', $formatEndTime);

        $time = $timeStartParts[0] . ':' . $timeStartParts[1] . ' - ' . $timeEndParts[0] . ':' . $timeEndParts[1] . ' ' . 'WIB';

        return $time;
    }

    public function searchEvent(Request $request)
    {
        $search = $request->input('valueSearch');
        $eventSearch = Event::with('organizer')->where('title', 'LIKE', '%' . $search . '%')->get();
        $result = [];

        if ($eventSearch->count() < 1) {
            return response()->json([], 422);
        }

        foreach ($eventSearch as $event) {
            $result[] = [
                'title' => $event->title,
                'banner' => Storage::url($event->banner),
                'organizer' => $event->organizer->name,
                'identifier' => $event->slug
            ];
        }
        return response()->json($result);
    }

    public function searchCity(Request $request)
    {
        $search = $request->input('valueCity');
        $city = City::where('city_name', 'LIKE', '%' . $search . '%')->get();

        return response()->json($city);
    }

    public function searchFormat(Request $request)
    {
        $search = $request->input('valueFormat');
        $format = FormatMix::where('format', 'LIKE', '%' . $search . '%')->get();

        return response()->json($format);
    }

    public function searchTopic(Request $request)
    {
        $search = $request->input('valueTopic');
        $topic = TopicMix::where('topic', 'LIKE', '%' . $search . '%')->get();

        return response()->json($topic);
    }

    public function choicedCategoryEvent(Request $request)
    {
        $id = $request->input('id');

        $events = Event::where('format_mix_id', $id)->get();
        $result = [];
        foreach ($events as $event) {
            $result[] = [
                'slug' => $event->slug,
                'banner' => Storage::url($event->banner)
            ];
        }

        return response()->json($result);
    }
}
