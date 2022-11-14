<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Administrator;

class AdministratorScope extends Model
{
    use HasFactory;

    protected $fillable = [
        'scope',
    ];

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
