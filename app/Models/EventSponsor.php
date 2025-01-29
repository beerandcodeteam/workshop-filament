<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventSponsor extends Pivot
{
    protected $fillable = [
        'event_id',
        'sponsor_id',
    ];


}
