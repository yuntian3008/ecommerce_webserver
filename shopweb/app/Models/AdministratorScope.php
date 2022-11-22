<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administrator;
use Laravel\Passport\Passport;

class AdministratorScope extends Model
{
    use HasFactory;

    protected $fillable = [
        'scope',
    ];

    protected $appends = [
        'description'
    ];

    public function getDescriptionAttribute()
    {
        if (!Passport::hasScope($this->scope)) return null;
        $scopes = Passport::scopesFor([$this->scope]);
        return $scopes[0]->description;
    }
    /**
     * Get the user that owns the AdministratorScope
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }
}
