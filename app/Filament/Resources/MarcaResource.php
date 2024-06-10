<?php

namespace App\Filament\Resources;

use App\Models\Marca;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class MarcaResource extends Resource
{
    protected static ?string $model = Marca::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $activeNavigationIcon = 'heroicon-s-collection';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->label('Nombre')
                    ->maxLength(255),

                Forms\Components\TextInput::make('enlace')
                    ->required()
                    ->label('Enlace')
                    ->maxLength(255)
                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                        if ($operation === 'create') {
                            $set('enlace', Str::slug($state));
                        }
                    }),

                Forms\Components\FileUpload::make('imagen')
                    ->required()
                    ->label('Imagen')
                    ->image()
                    ->maxFiles(1)
                    ->columnSpan(2),

                Forms\Components\Toggle::make('disponible')
                    ->label('Disponible')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->label('Nombre'),
                Tables\Columns\TextColumn::make('enlace')->label('Enlace'),
                Tables\Columns\ImageColumn::make('imagen')->label('Imagen'),
                Tables\Columns\BooleanColumn::make('disponible')->label('Disponible'),
                Tables\Columns\TextColumn::make('created_at')->label('Fecha de Creación')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Fecha de Actualización')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMarcas::route('/marcas'),
            'create' => Pages\CreateMarca::route('/marcas/create'),
            'edit' => Pages\EditMarca::route('/marcas/{record}/edit'),
        ];
    }
}
