<?php

namespace App\Filament\Resources\UsuariosResource\Pages;

use App\Filament\Resources\UsuariosResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ListUsuarios extends ListRecords
{
    protected static string $resource = UsuariosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Crear Usuario')
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->alignCenter()
                    ->label('Nombre de Usuario'),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->alignCenter()
                    ->label('Correo Electrónico'),

                IconColumn::make('is_admin')
                    ->sortable()
                    ->boolean()
                    ->alignCenter()
                    ->label('Administrador'),

                TextColumn::make('roles.name') ->sortable()->searchable()
                ->alignCenter(),

                TextColumn::make('email_verified_at')
                    ->label('Verificación de Correo')
                    ->alignCenter()
                    ->date(),
                TextColumn::make('deleted_at')
                ->date()
                ->label('Fecha de borrado')

            ])
            ->paginated([10, 25, 50, 100,])
            ->actions([
                ViewAction::make()
                    ->hiddenLabel(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->filters([
                TrashedFilter::make()
            ])
            ;
    }
}
