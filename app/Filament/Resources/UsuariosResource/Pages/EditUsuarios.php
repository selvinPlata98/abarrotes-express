<?php

namespace App\Filament\Resources\UsuariosResource\Pages;

    use App\Filament\Resources\UsuariosResource;
    use Filament\Actions\DeleteAction;
    use Filament\Resources\Pages\EditRecord;

    class EditUsuarios extends EditRecord {
        protected static string $resource = UsuariosResource::class;

        protected function getHeaderActions(): array {
        return [
        DeleteAction::make(),
        ];
        }
    }
