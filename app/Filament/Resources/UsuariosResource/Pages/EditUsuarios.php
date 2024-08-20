<?php

namespace App\Filament\Resources\UsuariosResource\Pages;

use App\Filament\Resources\UsuariosResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Exceptions\Cancel;

class EditUsuarios extends EditRecord
{
    protected ?string $heading = 'Editar Usuario';
    protected static ?string $title = 'Editar Usuario';
    protected static string $resource = UsuariosResource::class;

    protected function getHeaderActions(): array
    {
        return [

            DeleteAction::make(),
        ];
    }

    public function getRedirectUrl(): ?string
    {

        $recordId = $this->record?->id;


        if ($recordId) {
            $url = $this->getResource()::getUrl('view', ['record' => $recordId]) . '?sort=-created_at&tableSortColumn=id&tableSortDirection=desc';
            return $url;
        }

        return null;
    }
}
