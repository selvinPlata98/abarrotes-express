<?php

namespace App\Filament\Resources\CuponResource\Pages;

use App\Filament\Resources\CuponResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCupons extends ListRecords
{
    protected static string $resource = CuponResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
