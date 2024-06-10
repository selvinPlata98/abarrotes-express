<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $activeNavigationIcon = 'heroicon-s-shopping-cart';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    Section::make([
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->label('Nombre')
                            ->maxLength(255)
                            ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation
                            === 'create' ? $set('enlace', Str::slug($state)) : null)
                            ->reactive()
                            ->live(onBlur: true),

                        Forms\Components\TextInput::make('enlace')
                            ->required()
                            ->label('Enlace')
                            ->disabled()
                            ->dehydrated()
                            ->unique(Producto::class, ignoreRecord: true),

                        Forms\Components\FileUpload::make('imagenes')
                            ->required()
                            ->label('Imágenes')
                            ->multiple()
                            ->image()
                            ->maxFiles(5)
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('descripcion')
                            ->required()
                            ->label('Descripción')
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('precio')
                            ->required()
                            ->numeric()
                            ->label('Precio')
                            ->step('0.01'),

                        Forms\Components\TextInput::make('cantidad_disponible')
                            ->required()
                            ->numeric()
                            ->label('Cantidad Disponible')
                            ->step('1'),

                    ])->columns(2)
                    ->columnSpan(2), /*Fin de la seccion*/

                    Section::make([
                        Forms\Components\Toggle::make('disponible')
                            ->label('Disponible')
                            ->default(false),

                        Forms\Components\Toggle::make('en_oferta')
                            ->label('En Oferta')
                            ->default(false),

                        Forms\Components\TextInput::make('porcentaje_oferta')
                            ->numeric()
                            ->label('Porcentaje de Oferta')
                            ->nullable()
                            ->step('0.01')
                            ->maxValue(100)
                            ->regex('/^\d{1,3}(\.\d{1,2})?$/')
                            ->columns(2),

                        Forms\Components\BelongsToSelect::make('marca_id')
                            ->relationship('marca', 'nombre')
                            ->required()
                            ->label('Marca'),

                        Forms\Components\BelongsToSelect::make('categoria_id')
                            ->relationship('categoria', 'nombre')
                            ->required()
                            ->label('Categoría'),
                    ])->columnSpan(1)
                ])->columns(3)
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->label('Nombre'),
                Tables\Columns\TextColumn::make('enlace')->label('Enlace'),
                Tables\Columns\TextColumn::make('imagenes')->label('Imágenes')->limit(50),
                Tables\Columns\TextColumn::make('descripcion')->label('Descripción')->limit(50),
                Tables\Columns\TextColumn::make('precio')->label('Precio')->money('usd', true),
                Tables\Columns\BooleanColumn::make('disponible')->label('Disponible'),
                Tables\Columns\TextColumn::make('cantidad_disponible')->label('Cantidad Disponible'),
                Tables\Columns\BooleanColumn::make('en_oferta')->label('En Oferta'),
                Tables\Columns\TextColumn::make('porcentaje_oferta')->label('Porcentaje de Oferta'),
                Tables\Columns\TextColumn::make('marca.nombre')->label('Marca'), // Aquí se asume que la relación se llama "marca"
                Tables\Columns\TextColumn::make('categoria.nombre')->label('Categoría'),
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
