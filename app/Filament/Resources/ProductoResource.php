<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;
    protected static ?string $navigationGroup = 'Productos';
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
                            ->unique(Producto::class, ignoreRecord: true)
                            ->validationMessages([
                                'maxLength' => 'El nombre debe  contener un maximo de 80 carácteres.',
                                'required' => 'Debe introducir un nombre del producto',
                                'unique' => 'Este producto ya existe.'
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
                            ->unique(Producto::class, ignoreRecord: true)
                            ->validationMessages([
                                'unique' => 'Este enlace ya existe.'
                            ]),


                        Forms\Components\FileUpload::make('imagenes')
                            ->required()
                            ->label('Imágenes')
                            ->multiple(true)
                            ->image()
                            ->directory('productos')
                            ->visibility('public')
                            ->validationMessages([
                                'maxFiles' => 'Se permite un máximo de 5 imágenes.',
                                'required' => 'Debe seleccionar al menos una imagen.',
                                'image' => 'El archivo debe ser una imagen válida.',
                            ])
                            ->maxFiles(5)
                            ->columnSpan(2)
                            ->preserveFilenames()
                            ->reorderable()
                            ->openable(),

                        Forms\Components\MarkdownEditor::make('descripcion')
                            ->required()
                            ->label('Descripción')
                            ->toolbarButtons(
                                [
                                'bold',
                                'bulletList',
                                'heading',
                                'italic',
                                'link',
                                'redo',
                                'undo'],
                            )
                            ->maxlength(300)
                            ->validationMessages([
                                'required' => 'La descripción es obligatoria.',
                                'maxlength' => 'La descripción no puede exceder los 300 caracteres.'
                            ])
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('precio')->prefix('L.')
                            ->required()
                            ->inputMode('decimal')
                            ->numeric()
                            ->label('Precio')
                            ->step(0.01)
                            ->minValue(0)
                            ->validationMessages([
                                'required' => 'El precio es obligatorio.',
                                'numeric' => 'El precio debe ser un valor numérico.',
                                'regex' => 'El precio debe tener hasta 10 dígitos y 2 decimales.'
                            ]),

                        Forms\Components\TextInput::make('cantidad_disponible')
                            ->required()
                            ->numeric()
                            ->integer()
                            ->label('Cantidad Disponible')
                            ->step('1')
                            ->minValue(0),

                    ])->columns(2)
                        ->columnSpan(2), /*Fin de la seccion*/

                    Section::make([
                        Forms\Components\Toggle::make('disponible')
                            ->label('Disponible')
                            ->default(false),


                        Forms\Components\Toggle::make('en_oferta')
                            ->label('En Oferta')
                            ->default(false)
                            ->live(),

                        Group::make([

                        ]),
                        Forms\Components\TextInput::make('porcentaje_oferta')->prefix('%')
                            ->required()
                            ->numeric()
                            ->inputMode('decimal')
                            ->label('Porcentaje de Oferta')
                            ->nullable()
                            ->step('0.01')
                            ->default(0)
                            ->minValue(0)
                            ->maxValue(1)
                            ->validationMessages([
                                'required' => 'El porcentaje de oferta debe ser un valor numérico.',
                                'numeric' => 'El porcentaje de oferta debe ser un número.',
                                'minValue' => 'El porcentaje de oferta debe ser al menos 1.',
                                'maxValue' => 'El porcentaje de oferta no debe ser mayor a 100.',
                            ])
                            ->visible(fn(\Filament\Forms\Get $get): bool => $get('en_oferta'))
                            ->columns(2),


                        #Se cambió una librería antigua que marcaba como obsoleta.

                        Forms\Components\Select::make('marca_id')
                            ->relationship('marca', 'nombre')
                            ->required()
                            ->searchable()
                            #Precarga todas las marcas.
                            ->preload()
                            ->label('Marca')
                            ->validationMessages([
                                'required' => 'Debe seleccionar una marca.'
                            ]),


                        Forms\Components\Select::make('categoria_id')
                            ->relationship('categoria', 'nombre')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Categoría')
                            ->validationMessages([
                                'required' => 'Debe seleccionar una categoría.'
                            ]),
                    ])->columnSpan(1)
                ])->columns(3)
            ])->columns(1);
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
            'view' => ProductoResource\Pages\ViewProducto::route('/{record}/view')
        ];
    }


}
