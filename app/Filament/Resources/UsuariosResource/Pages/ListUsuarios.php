<?php

namespace App\Filament\Resources\UsuariosResource\Pages;

    use App\Filament\Resources\UsuariosResource;
    use Filament\Actions\CreateAction;
    use Filament\Resources\Pages\ListRecords;

    class ListUsuarios extends ListRecords {
        protected static string $resource = UsuariosResource::class;

        protected function getHeaderActions(): array {
        return [
        CreateAction::make(),
        ];
        }
    }
