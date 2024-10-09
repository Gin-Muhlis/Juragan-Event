<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'start_at',
        'end_at',
        'banner',
        'type',
        'slug',
        'description',
        'terms',
        'city_id',
        'organizer_id',
        'topic_mix_id',
        'format_mix_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function addressEvents()
    {
        return $this->hasMany(AddressEvent::class);
    }

    public function allTransactionHeaders()
    {
        return $this->hasMany(TransactionHeaders::class);
    }

    public function topicMix()
    {
        return $this->belongsTo(TopicMix::class);
    }

    public function formatMix()
    {
        return $this->belongsTo(FormatMix::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}
