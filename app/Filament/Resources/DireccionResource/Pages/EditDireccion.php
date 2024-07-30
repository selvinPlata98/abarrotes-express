<?php

namespace App\Filament\Resources\DireccionResource\Pages;

use App\Filament\Resources\DireccionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDireccion extends EditRecord
{
    protected static string $resource = DireccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function getRedirectUrl(): string
    {
        $url = $this->getResource()::getUrl('index') . '?sort=-created_at&tableSortColumn=id&tableSortDirection=desc';

        return $url;
    }
}
