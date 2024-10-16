<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class SamplingRecord extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static string $view = 'filament.pages.sampling-record';

    protected static ?int $navigationSort = 100;
}
