<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'slug',
        'brief-description',
        'image',
        'content',
        'user_id',
        'topic_mix_id',
    ];

    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topicMix()
    {
        return $this->belongsTo(TopicMix::class);
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function ($instance) {
            // update cache content
            Cache::put('posts.' . $instance->slug, $instance);
        });

        static::deleting(function ($instance) {
            // delete post cache
            Cache::forget('posts.' . $instance->slug);
        });
    }
}
