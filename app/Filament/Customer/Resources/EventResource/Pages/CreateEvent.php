<?php

namespace App\Filament\Customer\Resources\EventResource\Pages;

use App\Filament\Customer\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
}
