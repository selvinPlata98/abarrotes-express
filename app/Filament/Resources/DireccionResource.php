<?php

namespace App\Filament\Resources;

use App\Direccion;
use App\Filament\Resources\DireccionResource\Pages;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DireccionResource extends Resource
{
    protected static ?string $model = Direccion::class;

    protected static ?string $slug = 'direcciones';
    protected static ?string $pluralModelLabel = 'Direcciones';

    protected static ?string $navigationIcon = 'heroicon-o-globe-americas';
    protected static ?string $activeNavigationIcon =  'heroicon-s-globe-americas';
    protected static ?string $navigationGroup = 'Productos';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Direccion $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Direccion $record): string => $record?->updated_at?->diffForHumans() ?? '-'),

                TextInput::make('orden_id')
                    ->required()
                    ->integer(),

                TextInput::make('nombres')
                    ->required(),

                TextInput::make('apellidos')
                    ->required(),

                TextInput::make('telefono')
                    ->required(),

                TextInput::make('departamento')
                    ->required(),

                TextInput::make('municipio')
                    ->required(),

                TextInput::make('ciudad')
                    ->required(),

                TextInput::make('direccion_completa')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('orden_id'),

                TextColumn::make('nombres'),

                TextColumn::make('apellidos'),

                TextColumn::make('telefono'),

                TextColumn::make('departamento'),

                TextColumn::make('municipio'),

                TextColumn::make('ciudad'),

                TextColumn::make('direccion_completa'),
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
            'index' => Pages\ListDireccions::route('/'),
            'create' => Pages\CreateDireccion::route('/create'),
            'edit' => Pages\EditDireccion::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
