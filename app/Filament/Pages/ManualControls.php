<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ManualControls extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-ripple';
    protected static ?int $navigationSort = 190;
    protected static string $view = 'filament.pages.manual-controls';
}
