<?php

namespace App\Filament\Resources\ProductoResource\Pages;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
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

class ViewProducto extends ViewRecord
{
    protected static string $resource = ProductoResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    Section::make([
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->label('Nombre del Producto')
                            ->maxLength(80)
                            ->regex('/^[A-Za-zÀ-ÿ\s]+$/')
                            ->validationMessages([
                                'maxLength' => 'El nombre debe contener un máximo de 80 caracteres.',
                                'required' => 'Debe introducir un nombre del producto',
                                'regex' => 'El nombre solo debe contener letras y espacios.'
                            ])
                            ->unique(Producto::class, ignoreRecord: true,)
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

                        Forms\Components\TextInput::make('descripcion')
                            ->required()
                            ->label('Descripción')
                            ->maxLength(800)
                            ->regex('/^[A-Za-zÀ-ÿ0-9.,!?()"\s-]+$/')
                            ->validationMessages([
                                'required' => 'La descripción es obligatoria.',
                                'maxlength' => 'La descripción no puede exceder los 800 caracteres.',
                                'regex' => 'La descripción solo puede contener letras, números y caracteres de puntuación comunes.'
                            ])
                            ->columnSpan(2),


                        Forms\Components\TextInput::make('precio')
                            ->required()
                            ->numeric()
                            ->regex('/^(\d{1,8})(\.\d{1,2})?$/')
                            ->label('Precio')
                            ->minValue(0)
                            ->validationMessages([
                                'required' => 'El precio es obligatorio.',
                                'numeric' => 'El precio debe ser un valor numérico.',
                                'regex' => 'El precio debe tener hasta 10 dígitos y 2 decimales.'
                            ]),

                        Forms\Components\TextInput::make('cantidad_disponible')
                            ->required()
                            ->numeric()
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

                        Forms\Components\TextInput::make('porcentaje_oferta')
                            ->required()
                            ->numeric()
                            ->label('Porcentaje de Oferta')
                            ->nullable()
                            ->step('0.01')
                            ->maxValue(1)
                            ->minValue(0)
                            ->regex('/^(0\.00|1\.00|0\.[0-9]{1,2}|1\.0{1,2})$/')
                            ->validationMessages([
                                'required' => 'El porcentaje de oferta debe ser un valor numérico.',
                                'regex' => 'El porcentaje de oferta debe tener hasta 1 dígito enteros y hasta 2 decimales.'
                            ])
                            ->visible(fn(\Filament\Forms\Get $get):bool => $get('en_oferta'))
                            ->columns(2),



                        #Se cambió una librería antigua que marcaba como obsoleta.

                        Forms\Components\Select::make('marca_id')
                            ->relationship('marca', 'nombre')
                            ->required()
                            ->searchable()
                            #Precarga todas las marcas.
                            ->preload()
                            ->label('Marca'),


                        Forms\Components\Select::make('categoria_id')
                            ->relationship('categoria', 'nombre')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Categoría'),
                    ])->columnSpan(1)
                ])->columns(3)
            ])->columns(1);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
