<?php

namespace App\Filament\Resources\OrdenResource\Pages;

use App\Filament\Resources\OrdenResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrden extends EditRecord
{
    protected static string $resource = OrdenResource::class;

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
