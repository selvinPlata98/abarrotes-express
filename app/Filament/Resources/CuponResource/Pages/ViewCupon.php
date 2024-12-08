<?php

namespace App\Filament\Resources\CuponResource\Pages;

use App\Filament\Resources\CuponResource;
use App\Models\Cupon;
use Filament\Actions;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\CuponResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ViewCupon extends ViewRecord
{
    protected static string $resource = CuponResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make()
        ];
    }

    public  function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    Section::make([
                        Forms\Components\TextInput::make('codigo')
                            ->required()
                            ->maxLength(8)
                            ->label('Código del Cupón')
                            ->unique(Cupon::class, ignoreRecord: true)
                            ->validationMessages([
                                'required' => 'El código es obligatorio.',
                                'unique' => 'Este código ya existe.',
                            ]),

                        Forms\Components\TextInput::make('descuento')->prefix('%')
                            ->required()
                            ->label('Descuento')
                            ->numeric()
                            ->step('0.01')
                            ->default(0)
                            ->minValue(0)
                            ->maxValue(1)
                            ->validationMessages([
                                'required' => 'El descuento es obligatorio.',
                            ]),

                        Forms\Components\DatePicker::make('fecha_inicio')
                            ->required()
                            ->label('Fecha de Inicio')
                            ->rules('before_or_equal:today')
                            ->validationMessages([
                                'required' => 'La fecha de inicio es obligatoria.',
                            ]),

                        Forms\Components\DatePicker::make('fecha_expiracion')
                            ->required()
                            ->rules('after:fecha_inicio', 'before_or_equal:' . now()->addYears(1)->toDateString())
                            ->label('Fecha de Expiración')
                            ->validationMessages([
                                'required' => 'La fecha de expiración es obligatoria.',
                            ]),

                        Forms\Components\Select::make('usuario_id')
                            ->relationship('usuario', 'name')
                            ->nullable()
                            ->searchable()
                            ->native(false)
                            ->label('Usuario'),

                        Forms\Components\Select::make('orden_id')
                            ->relationship('orden', 'id')
                            ->nullable()
                            ->native(false)
                            ->label('Orden'),

                        Forms\Components\Select::make('producto_id')
                            ->relationship('producto', 'nombre')
                            ->nullable()
                            ->searchable()
                            ->native(false)
                            ->label('Producto'),

                        Forms\Components\Select::make('categoria_id')
                            ->relationship('categoria', 'nombre')
                            ->nullable()
                            ->searchable()
                            ->native(false)
                            ->label('Categoría'),

                        Forms\Components\Select::make('marca_id')
                            ->relationship('marca', 'nombre')
                            ->nullable()
                            ->searchable()
                            ->native(false)
                            ->label('Marca'),

                        Forms\Components\Toggle::make('estado')
                            ->label('Estado')
                            ->default(true),
                    ])->columns(3)
                ])->columnSpan(2)

            ]);
    }


}
