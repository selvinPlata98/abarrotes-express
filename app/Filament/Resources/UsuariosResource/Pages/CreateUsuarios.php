<?php

namespace App\Filament\Resources\UsuariosResource\Pages;

use App\Filament\Resources\UsuariosResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUsuarios extends CreateRecord
{
    protected static string $resource = UsuariosResource::class;
    protected ?string $heading = 'Crear Usuario';

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
