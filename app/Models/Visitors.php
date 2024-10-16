<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visitors extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['post_id', 'ip_address'];

    protected $searchableFields = ['*'];
}
