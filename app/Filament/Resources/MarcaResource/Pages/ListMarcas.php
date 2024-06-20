<?php

namespace App\Filament\Resources\MarcaResource\Pages;

use App\Filament\Resources\MarcaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Table;

class ListMarcas extends ListRecords
{
    protected static string $resource = MarcaResource::class;
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->label('Nombre'),
                Tables\Columns\TextColumn::make('enlace')->label('Enlace'),
                Tables\Columns\ImageColumn::make('imagen')->label('Imagen')->limit(1),
                Tables\Columns\BooleanColumn::make('disponible')->label('Disponible'),
            ])
            ->filters([
                // Aquí puedes añadir filtros si es necesario
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->hiddenLabel(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}