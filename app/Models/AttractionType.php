<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttractionType extends Model
{
    protected $fillable = [
        'name'
    ];

    public function attractions(): HasMany
    {
        return $this->hasMany(Attraction::class);
    }
}
