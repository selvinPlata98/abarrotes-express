<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
}
