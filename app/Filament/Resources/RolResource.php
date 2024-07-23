<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RolResource\Pages;
use App\Filament\Resources\RolResource\RelationManagers\PermissionsRelationManager;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;

class RolResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $slug = 'roles';

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';

    protected static ?string $activeNavigationIcon = 'heroicon-o-finger-print';
    protected static ?string $pluralModelLabel = 'Roles';
    protected static ?string $navigationGroup = 'Usuarios';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Rol';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([

                    Section::make([
                        TextInput::make('name')
                            ->label('Nombre del rol')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->columns(1),

                        Placeholder::make('created_at')
                            ->label('Fecha de Creación')
                            ->content(fn(?Role $record): string => $record?->created_at?->diffForHumans() ?? '-')
                            ->columns(1),

                        Placeholder::make('updated_at')
                            ->label('Última modificación')
                            ->content(fn(?Role $record): string => $record?->updated_at?->diffForHumans() ?? '-')
                            ->columns(1),
                    ])->columns(3),

                    Select::make('permissions')
                        ->relationship('permissions', 'name')
                        ->multiple()
                        ->preload(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRols::route('/'),
            'create' => Pages\CreateRol::route('/create'),
            'edit' => Pages\EditRol::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    public static function getRelations(): array
    {
        return [
            PermissionsRelationManager::class
        ];
    }
}
