<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages\ViewUser;
use App\Filament\Resources\UsuariosResource\Pages;
use App\Filament\Resources\UsuariosResource\RelationManagers\RolesRelationManager;
use App\Models\User;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\StatsOverviewWidget\Stat;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class UsuariosResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'usuarios';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Usuarios';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $activeNavigationIcon = 'heroicon-s-users';
    protected static ?string $pluralModelLabel = 'Usuarios';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Nombre de Usuario')
                    ->maxLength(100)
                    ->regex('/^[A-Za-zÀ-ÿñÑ ]+$/')
                    ->validationMessages([
                        'required' => 'Debe introducir un nombre de usuario.',
                        'max' => 'El nombre no debe contener más de 100 carácteres.',
                        'regex' => 'El nombre de usuario no debe contener símbolos',
                    ]),

                TextInput::make('email')
                    ->required()
                    ->rules(['regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/'])->email()
                    ->unique(ignoreRecord: true)
                    ->maxLength(100)->label('Correo Electrónico')
                    ->validationMessages([
                        'required' => 'Debe introducir un correo electrónico.',
                        'email' => 'Debe introducir un correo electrónico válido.',
                        'unique' => 'El correo ingresado se encuentra en uso, introduzca uno nuevo.',
                        'max' => 'El correo debe contener menos de 100 carácteres.',
                        'regex' => 'Debe introducir un correo electrónico válido.'
                        ]),

                CheckboxList::make('roles')
                    ->relationship('roles', 'name')
                    ->columns(2)
                    ->required()
                    ->maxItems(1)
                    ->exists('roles', 'id')
                    ->hint('Solo se debe seleccionar un Rol')
                    ->validationMessages([
                        'required' => 'Debe seleccionar un rol.',
                        'max' => 'Debe seleccionar solamente un rol.',
                        'exists' => 'El Rol seleccionado no es válido'
                    ]),

                DateTimePicker::make('email_verified_at')
                    ->label('Fecha de verificación de Correo'),

                TextInput::make('password')
                    ->label('Contraseña')
                    ->revealable()
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->maxLength(18)
                    ->dehydrated(static fn(null|string $state):
                    null|string => filled($state ? \Hash::make($state) : null))
                    ->required(fn(Page $livewire): bool => $livewire instanceof Pages\CreateUsuarios)
                    ->dehydrated(static fn(null|string $state):
                    bool => filled($state))
                    ->validationMessages([
                        'password' => 'Debe introducir una contraseña valida',
                        'required' => 'Debe introducir una contraseña',
                        'min' => 'La contraseña no debe tener menos de 8 carácteres.',
                        'max' => 'La contraseña no debe tener más de 18 carácteres.'
                    ]),


                Placeholder::make('created_at')
                    ->label('Fecha de creación')
                    ->content(fn(?User $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Ultima modificación')
                    ->content(fn(?User $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsuarios::route('/'),
            'create' => Pages\CreateUsuarios::route('/create'),
            'edit' => Pages\EditUsuarios::route('/{record}/edit'),
            'view' => Pages\ViewUsuario::route('/{record}/view')
        ];
    }

    public static function getRelations(): array
    {
        return [
            RolesRelationManager::class
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }
}
