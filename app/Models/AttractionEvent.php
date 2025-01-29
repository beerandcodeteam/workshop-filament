<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AttractionEvent extends Pivot
{
    protected $fillable = [
        'attraction_id',
        'event_id',
        'schedule'
    ];
}
