<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'city_id',
        'user_id',
        'event_id',
        'state_id',
        'zipcode',
        'address',
        'number',
        'district',
        'complement',
        'location',
        'latitude',
        'longitude',
        'deleted_at',
    ];

    public function city(): BelongsTo
    {
        return$this->belongsTo(City::class);
    }

    public function state(): BelongsTo
    {
        return$this->belongsTo(State::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
