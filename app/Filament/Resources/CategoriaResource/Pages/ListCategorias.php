<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategorias extends ListRecords
{
    protected static string $resource = CategoriaResource::class;


    public function table(Table $table): Table
    {
        return $table
            ->columns(components: [
                TextColumn::make('nombre')->label('Nombre')
                    ->searchable(),
                TextColumn::make('enlace')->label('Enlace'),
                TextColumn::make('imagen')->label('Imagen')


            ])
            ->filters([
                //
            ])
            ->actions(actions: [
                ViewAction::make() ->hiddenLabel()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public  function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->label('Nombre'),
                TextColumn::make('enlace')->label('Enlace'),
                ImageColumn::make('imagen')->label('Imagen')
            ])
            ->paginated([10, 25, 50, 100,])

            ->actions([
                ViewAction::make()
                    ->hiddenLabel()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
