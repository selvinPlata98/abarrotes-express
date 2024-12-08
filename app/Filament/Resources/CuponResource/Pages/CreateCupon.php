<?php

namespace App\Filament\Resources\CuponResource\Pages;

use App\Filament\Resources\CuponResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCupon extends CreateRecord
{
    protected static string $resource = CuponResource::class;

    public function getRedirectUrl(): string
    {
        $url = $this->getResource()::getUrl('index') . '?sort=-created_at&tableSortColumn=id&tableSortDirection=desc';

        return $url;
    }
}
