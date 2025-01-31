<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    protected $fillable = [
        'event_status_id',
        'event_type_id',
        'name',
        'description',
        'schedule',
        'cover',
    ];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function attractions(): BelongsToMany
    {
        return $this->belongsToMany(Attraction::class)
            ->withPivot('schedule');
    }

    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class);
    }

    public function sponsors(): BelongsToMany
    {
        return $this->belongsToMany(Sponsor::class);
    }

    public function eventStatus(): BelongsTo
    {
        return $this->belongsTo(EventStatus::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
