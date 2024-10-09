<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Refund extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['date', 'reason', 'transaction_headers_id', 'status'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function transactionHeaders()
    {
        return $this->belongsTo(TransactionHeaders::class);
    }
}
