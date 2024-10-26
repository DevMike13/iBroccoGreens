<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CycleDetails extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    protected static string $view = 'filament.pages.cycle-details';

    protected static ?int $navigationSort = 40;
}
