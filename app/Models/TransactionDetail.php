<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'quantity',
        'unit_price',
        'total_price',
        'transaction_headers_id',
        'ticket_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'transaction_details';

    public function transactionHeaders()
    {
        return $this->belongsTo(TransactionHeaders::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
