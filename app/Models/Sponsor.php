<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsor extends Model
{
    protected $fillable = [
        'name',
        'thumbnail',
        'url',
    ];

    public function event(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
}
