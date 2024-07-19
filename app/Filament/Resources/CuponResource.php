<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CuponResource\Pages;
use App\Models\Cupon;
use App\Filament\Resources\ProductoResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CuponResource extends Resource
{
    protected static ?string $model = Cupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $pluralLabel = "Cupones";

    protected static ?string $navigationGroup = 'Tienda';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    Section::make([
                        Forms\Components\TextInput::make('codigo')
                            ->required()
                            ->label('Código del Cupón')
                            ->unique(Cupon::class, ignoreRecord: true)
                            ->validationMessages([
                                'required' => 'El código es obligatorio.',
                                'unique' => 'Este código ya existe.',
                            ]),

                        Forms\Components\TextInput::make('descuento')
                            ->required()
                            ->label('Descuento')
                            ->numeric()
                            ->validationMessages([
                                'required' => 'El descuento es obligatorio.',
                            ]),

                        Forms\Components\DatePicker::make('fecha_inicio')
                            ->required()
                            ->label('Fecha de Inicio')
                            ->validationMessages([
                                'required' => 'La fecha de inicio es obligatoria.',
                            ]),

                        Forms\Components\DatePicker::make('fecha_expiracion')
                            ->required()
                            ->label('Fecha de Expiración')
                            ->validationMessages([
                                'required' => 'La fecha de expiración es obligatoria.',
                            ]),

                        Forms\Components\Select::make('usuario_id')
                            ->relationship('usuario', 'name')
                            ->nullable()
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
                            ->native(false)
                            ->label('Producto'),

                        Forms\Components\Select::make('categoria_id')
                            ->relationship('categoria', 'nombre')
                            ->nullable()
                            ->native(false)
                            ->label('Categoría'),

                        Forms\Components\Select::make('marca_id')
                            ->relationship('marca', 'nombre')
                            ->nullable()
                            ->native(false)
                            ->label('Marca'),

                        Forms\Components\Toggle::make('estado')
                            ->label('Estado')
                            ->default(true),
                    ])->columns(3)
                ])->columnSpan(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->label('Código del Cupón'),
                Tables\Columns\TextColumn::make('descuento')
                    ->label('Descuento'),
                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->label('Fecha de Inicio'),
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

        ];

    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCupons::route('/'),
            'create' => Pages\CreateCupon::route('/create'),
            'edit' => Pages\EditCupon::route('/{record}/edit'),
        ];
    }
}
