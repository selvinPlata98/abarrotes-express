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
                            ->label('Nombre del Producto')
                            ->maxLength(80)
                            ->validationMessages([
                                'maxLenght' => 'El nombre debe  contener un maximo de 80 carácteres.',
                                'required' => 'Debe introducir un nombre del producto',
                                'regex' => 'El nombre solo debe contener letras y espacios.'
                            ])
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
                            ->validationMessages([
                                'maxFiles' => 'Se permite un máximo de 5 imágenes.',
                                'required' => 'Debe seleccionar al menos una imagen.',
                                'image' => 'El archivo debe ser una imagen válida.',
                            ])
                            ->maxFiles(5)
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('descripcion')
                            ->required()
                            ->label('Descripción')
                            ->maxlength(300)
                            ->validationMessages([
                                'required' => 'La descripción es obligatoria.',
                                'maxlength' => 'La descripción no puede exceder los 300 caracteres.'
                            ])
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('precio')
                            ->required()
                            ->numeric()
                            ->regex('^(\d{1,8})(\.\d{1,2})?$')
                            ->label('Precio')
                            ->validationMessages([
                                'required' => 'El precio es obligatorio.',
                                'numeric' => 'El precio debe ser un valor numérico.',
                                'regex' => 'El precio debe tener hasta 10 dígitos y 2 decimales.'
                            ])
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
                            ->validationMessages([
                                'numeric' => 'El porcentaje de oferta debe ser un valor numérico.',
                                'maxValue' => 'El porcentaje de oferta no puede ser mayor que 100.',
                                'regex' => 'El porcentaje de oferta debe tener hasta 3 dígitos enteros y hasta 2 decimales.'
                            ])
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
