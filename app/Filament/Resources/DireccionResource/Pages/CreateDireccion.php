<?php

namespace App\Filament\Resources\DireccionResource\Pages;

use App\Filament\Resources\DireccionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDireccion extends CreateRecord
{
    protected static string $resource = DireccionResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
