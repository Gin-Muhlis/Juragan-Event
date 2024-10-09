<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'email',
        'google_id',
        'facebook_id',
        'phone_number',
        'image',
        'password',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function allTransactionHeaders()
    {
        return $this->hasMany(TransactionHeaders::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }

    public function isSuper()
    {
        return $this->hasRole('super');
    }
}
