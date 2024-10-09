<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Juragan extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'banner_website',
        'address',
        'email',
        'phone_number',
        'copyright_text',
        'coordinate',
        'logo_website',
        'link_fb',
        'link_twitter',
        'link_instagram',
        'link_youtube',
        'short_description',
        'long_description',
        'contact_description',
    ];

    protected $searchableFields = ['*'];
}
