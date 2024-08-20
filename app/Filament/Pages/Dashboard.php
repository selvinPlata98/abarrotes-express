<?php

namespace App\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $title = 'Inicio';
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $activeNavigationIcon = 'heroicon-s-home';

}
