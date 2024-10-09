<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionHeaders extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'transaction_date',
        'no_transaction',
        'total_transaction',
        'status',
        'event_id',
        'user_id',
        'payment_id',
        'proof_of_payment'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'transaction_headers';

    protected $casts = [
        'transaction_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
