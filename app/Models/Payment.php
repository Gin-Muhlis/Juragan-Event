<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'icon', 'fee_service'];

    protected $searchableFields = ['*'];

    public function allTransactionHeaders()
    {
        return $this->hasMany(TransactionHeaders::class);
    }
}
