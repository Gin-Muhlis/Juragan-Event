<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organizer extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'icon'];

    protected $searchableFields = ['*'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
