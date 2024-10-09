<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormatMix extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['format'];

    protected $searchableFields = ['*'];

    protected $table = 'format_mixes';

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
