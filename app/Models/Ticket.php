<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quota',
        'star_sale_at',
        'end_sale_at',
        'type',
        'event_id',
        'discount',
        'fee_admin',
        'tax_coast',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'star_sale_at' => 'datetime',
        'end_sale_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
