<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TopicMix extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['topic'];

    protected $searchableFields = ['*'];

    protected $table = 'topic_mixes';

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
