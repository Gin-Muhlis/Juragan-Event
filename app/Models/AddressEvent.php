<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AddressEvent extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['address', 'longitude', 'latitutde', 'event_id'];

    protected $searchableFields = ['*'];

    protected $table = 'address_events';

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
