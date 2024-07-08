<?php

namespace App\Filament\Resources\ProductoResource\Pages;

use App\Filament\Resources\ProductoResource;
use App\Models\Marca;
use App\Models\Producto;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditProducto extends EditRecord
{
    protected static string $resource = ProductoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    Section::make([
                        TextInput::make('nombre')
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

                        TextInput::make('enlace')
                            ->required()
                            ->label('Enlace')
                            ->disabled()
                            ->dehydrated()
                            ->unique(Producto::class, ignoreRecord: true)
                            ->validationMessages([
                                'unique' => 'Este enlace ya existe.'
                            ]),


                        FileUpload::make('imagenes')
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
                            ->reorderable()
                            ->openable(),

                        MarkdownEditor::make('descripcion')
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

                        TextInput::make('precio')
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

                        TextInput::make('cantidad_disponible')
                            ->required()
                            ->numeric()
                            ->integer()
                            ->label('Cantidad Disponible')
                            ->step('1')
                            ->minValue(0),

                    ])->columns(2)
                        ->columnSpan(2), /*Fin de la seccion*/

                    Section::make([
                        Toggle::make('disponible')
                            ->label('Disponible')
                            ->default(false),


                        Toggle::make('en_oferta')
                            ->label('En Oferta')
                            ->default(false)
                            ->live(),

                        TextInput::make('porcentaje_oferta')

                            ->required()
                            ->numeric()
                            ->label('Porcentaje de Oferta')
                            ->nullable()
                            ->step('0.01')
                            ->minValue(0)
                            ->maxValue(100)
                            ->validationMessages([
                                'required' => 'El porcentaje de oferta debe ser un valor numérico.',
                                'regex' => 'El porcentaje de oferta debe tener hasta 3 dígitos enteros y hasta 2 decimales.',
                                'max' => 'El valor maximo permitido es 100'
                            ])
                            ->disabled(fn (Get $get): ?bool => ! $get('en_oferta'))
                            ->visible()
                            ->columns(2),


                        #Se cambió una librería antigua que marcaba como obsoleta.

                        Select::make('marca_id')
                            ->relationship('marca', 'nombre')
                            ->required()
                            ->searchable()
                            #Precarga todas las marcas.
                            ->preload()
                            ->label('Marca')
                            ->validationMessages([
                                'required' => 'Debe seleccionar una marca.'
                            ]),


                        Select::make('categoria_id')
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
}
