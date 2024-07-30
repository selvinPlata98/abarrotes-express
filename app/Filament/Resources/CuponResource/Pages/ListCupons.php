<?php

namespace App\Filament\Resources\CuponResource\Pages;

use App\Filament\Resources\CuponResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use App\Filament\Resources\CuponResource\Pages;
use App\Models\Cupon;
use App\Filament\Resources\ProductoResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;


class ListCupons extends ListRecords
{
    protected static string $resource = CuponResource::class;

    public  function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->label('Código del Cupón'),
                Tables\Columns\TextColumn::make('descuento')
                    ->label('Descuento'),
                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->label('Fecha de InicioPage'),
                Tables\Columns\TextColumn::make('fecha_expiracion')
                    ->label('Fecha de Expiración'),
                Tables\Columns\BooleanColumn::make('estado')
                    ->label('Estado'),
                Tables\Columns\TextColumn::make('usuario.name')
                    ->label('Usuario'),
                Tables\Columns\TextColumn::make('orden.id')
                    ->label('Orden'),
                Tables\Columns\TextColumn::make('producto.nombre')
                    ->label('Producto'),
                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->label('Categoría'),
                Tables\Columns\TextColumn::make('marca.nombre')
                    ->label('Marca'),
            ])
            ->paginated([10, 25, 50, 100,])

            ->actions([
                Tables\Actions\EditAction::make(),
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
