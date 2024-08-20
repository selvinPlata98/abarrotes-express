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
                                ->maxLength(70)
                                ->regex('/^[A-Za-zÀ-ÿ0-9\s\-\'\.]+$/')
                                ->unique(Producto::class, ignoreRecord: true)
                                ->autocomplete('off')
                                ->columnSpanFull()
                                ->validationMessages([
                                    'max' => 'El nombre debe contener un máximo de :max caracteres.',
                                    'required' => 'Debe introducir un nombre del producto.',
                                    'unique' => 'Este producto ya existe.',
                                    'regex' => 'El nombre del producto solo puede contener letras, números y los caracteres especiales permitidos.'
                                ]),

                            Forms\Components\FileUpload::make('imagenes')
                                ->required()
                                ->label('Imágenes')
                                ->multiple(true)
                                ->hint('Solo se puede cargar un máximo de 5 imágenes')
                                ->image()
                                ->directory('productos')
                                ->imageEditor()
                                ->imageResizeMode('cover')
                                ->imageCropAspectRatio('1:1')
                                ->maxSize(5190)
                                ->maxFiles(5)
                                ->columnSpan(2)
                                ->preserveFilenames()
                                ->reorderable()
                                ->openable()
                                ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg'])
                                ->validationMessages([
                                    'maxFiles' => 'Se permite un máximo de 5 imágenes.',
                                    'required' => 'Debe seleccionar al menos una imagen.',
                                    'image' => 'El archivo debe ser una imagen válida.',
                                    'max' => 'El tamaño de la imagen no debe exceder los 5MB.',
                                    'accepted' => 'Solo se permiten imágenes en formato PNG, JPEG, o JPG.',
                                ]),

                            Forms\Components\MarkdownEditor::make('descripcion')
                                ->required()
                                ->label('Descripción')
                                ->placeholder('Escribe una breve descripción...')
                                ->toolbarButtons([
                                    'bold',
                                    'bulletList',
                                    'heading',
                                    'italic',
                                    'link',
                                    'redo',
                                    'undo'],
                                )
                                ->minLength(10)
                                ->maxlength(300)
                                ->validationMessages([
                                    'required' => 'La descripción es obligatoria.',
                                    'min' => 'La descripción debe tener al menos :min caracteres.',
                                    'max' => 'La descripción no puede exceder los :max caracteres.'
                                ])
                                ->columnSpan(2),

                        ])->columns(2)
                            ->columnSpan(2),


    Section::make([

        Forms\Components\TextInput::make('precio')->prefix('L.')
            ->required()
            ->inputMode('decimal')
            ->numeric()
            ->label('Precio')
            ->regex('/^\d{1,10}(\.\d{1,2})?$/')
            ->placeholder(0.00)
            ->autocomplete('off')
            ->step(0.01)
            ->minValue(1)
            ->validationMessages([
                'required' => 'El precio es obligatorio.',
                'numeric' => 'El precio debe ser un valor numérico.',
                'regex' => 'El precio debe tener hasta 10 dígitos enteros y 2 decimales.'
            ]),

        Forms\Components\TextInput::make('cantidad_disponible')
            ->required()
            ->numeric()
            ->integer()
            ->inputMode('numeric')
            ->label('Cantidad Disponible')
            ->placeholder(0)
            ->step('1')
            ->minValue(1)
            ->autocomplete('off')
            ->validationMessages([
                'required' => 'La cantidad es obligatoria.',
                'numeric' => 'La cantidad debe ser un valor numérico.',
                'integer' => 'La cantidad debe ser un número entero.',
                'min' => 'La cantidad disponible debe ser al menos 1.',
            ]),

        Forms\Components\Toggle::make('disponible')
            ->label('Disponible')
            ->default(false)
            ->rules(['boolean'])
            ->validationMessages([
                'boolean' => 'El valor debe ser verdadero o falso.',
            ]),

        Forms\Components\Toggle::make('en_oferta')
            ->label('En Oferta')
            ->default(false)
            ->live()
            ->rules(['boolean'])
            ->validationMessages([
                'boolean' => 'El valor debe ser verdadero o falso.',
            ]),

        Group::make([]),

        Forms\Components\TextInput::make('porcentaje_oferta')->prefix('%')
            ->required()
            ->numeric()
            ->inputMode('decimal')
            ->label('Porcentaje de Oferta')
            ->nullable()
            ->step('1')
            ->placeholder(0)
            ->minValue(1)
            ->maxValue(100)
            ->autocomplete('off')
            ->validationMessages([
                'required' => 'El porcentaje de oferta es obligatorio.',
                'numeric' => 'El porcentaje de oferta debe ser un número.',
                'minValue' => 'El porcentaje de oferta debe ser al menos 1.',
                'maxValue' => 'El porcentaje de oferta no debe ser mayor a 100.',
            ])
            ->visible(fn(\Filament\Forms\Get $get): bool => $get('en_oferta'))
            ->columns(2),

        Forms\Components\Select::make('marca_id')
            ->relationship('marca', 'nombre')
            ->required()
            ->searchable()
            ->preload()
            ->label('Marca')
            ->rules(['exists:marcas,id'])
            ->validationMessages([
                'required' => 'Debe seleccionar una marca.',
                'exists' => 'La marca seleccionada no es válida.',
            ]),


        Forms\Components\Select::make('categoria_id')
            ->relationship('categoria', 'nombre')
            ->required()
            ->searchable()
            ->preload()
            ->label('Categoría')
            ->rules(['exists:categorias,id'])
            ->validationMessages([
                'required' => 'Debe seleccionar una categoría.',
                'exists' => 'La categoría seleccionada no es válida.',
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
