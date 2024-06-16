<?php

namespace App\Filament\Resources\UsuariosResource\Pages;

use App\Filament\Resources\UsuariosResource;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Table;

class ViewUser extends ViewRecord
{
    protected static string $resource = UsuariosResource::class;
    protected ?string $heading = 'Detalles de Usuario';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextInput::make('name')
                    ->required()
                    ->label('Nombre de Usuario')
                    ->maxLength(100)
                    ->regex('/^[A-Za-z ]+$/')
                    ->validationMessages([
                        'maxLenght' => 'El nombre no debe contener más de 100 carácteres.',
                        'required' => 'Debe introducir un nombre de usuario.',
                        'regex' => 'El nombre solo debe contener letras y espacios.'
                    ]),

                TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->maxLength(100)                    ->label('Correo Electrónico')
                    ->validationMessages([
                        'required' => 'Debe introducir un correo electrónico.',
                        'email' => 'Debe introducir un correo electrónico válido.',
                        'unique' => 'El correo ingresado se encuentra en uso, introduzca uno nuevo.'
                    ]),

                DateTimePicker::make('email_verified_at')
                    ->label('Fecha de verificación de Correo'),

                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->revealable()
                    ->required()
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord)
                    ->validationMessages([
                        'required' => 'Debe introducir una contraseña',
                    ]),


                Placeholder::make('created_at')
                    ->label('Fecha de creación')
                    ->content(fn(?User $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Ultima modificación')
                    ->content(fn(?User $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
