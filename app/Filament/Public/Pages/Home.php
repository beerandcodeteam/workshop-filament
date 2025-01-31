<?php

namespace App\Filament\Public\Pages;

use App\Models\Event;
use Filament\Pages\Page;

class Home extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.public.pages.home';

    public $events;

    public function mount()
    {
        $this->events = Event::all();
    }
}
