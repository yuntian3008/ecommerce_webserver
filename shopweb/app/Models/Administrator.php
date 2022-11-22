<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Database\Factories\Administrator\SAFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\AdministratorScope;

class Administrator extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected static function newFactory()
    {
        return SAFactory::new();
    }

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'block',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all of the comments for the Administrator
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function administratorScopes()
    {
        return $this->hasMany(AdministratorScope::class);
    }

}
