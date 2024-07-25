<?php

namespace App\Filament\Resources\ProductoResource\Pages;

use App\Filament\Resources\ProductoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Table;

class ListProductos extends ListRecords
{
    protected static string $resource = ProductoResource::class;

    public  function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->label('Nombre'),
                Tables\Columns\TextColumn::make('enlace')->label('Enlace'),
                #Tables\Columns\ImageColumn::make('imagenes')->label('Imagen')->circular()->stacked()->limit(1),
                Tables\Columns\TextColumn::make('precio')->label('Precio')->money('lps', true),
                Tables\Columns\TextColumn::make('cantidad_disponible')->label('Cantidad Disponible')
                ->alignCenter(),
                Tables\Columns\TextColumn::make('marca.nombre')->label('Marca'),
                Tables\Columns\TextColumn::make('categoria.nombre')->label('Categoría'),

            ])
            ->paginated([10, 25, 50, 100,])
            ->filters([
                //
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
