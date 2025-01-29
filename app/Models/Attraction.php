<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attraction extends Model
{
    protected $fillable = [
        'attraction_type_id',
        'name',
        'description',
        'cover',
    ];

    public function attractionType(): BelongsTo
    {
        return $this->belongsTo(AttractionType::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
}
