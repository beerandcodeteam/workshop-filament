<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventStatus extends Model
{
    protected $fillable = [
        'name'
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
