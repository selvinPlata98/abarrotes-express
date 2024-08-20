<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrdenResource\Pages;
use App\Filament\Resources\OrdenResource\RelationManagers\DireccionRelationManager;
use App\Models\Orden;
use App\Models\Producto;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrdenResource extends Resource
{
    protected static ?string $model = Orden::class;

    protected static ?string $slug = 'ordenes';
    protected static ?string $modelLabel = 'Ordenes';
    protected static ?string $navigationGroup = 'Tienda';
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?int $navigationSort = 2;

    protected static ?string $activeNavigationIcon =
        'heroicon-s-truck';

    public static function getRecordTitle(Orden|Model|null $record): string
    {
        return 'Orden ' . $record->id;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    Section::make([
                        Section::make([
                            Select::make('user_id')
                                ->relationship('user', 'email')
                                ->exists('users', 'id')
                                ->label('Usuario')
                                ->searchable()
                                ->required()
                                ->validationMessages([
                                    'relationship' => 'Se debe seleccionar un usuario existente.',
                                    'exists' => 'Debe seleccionar un usuario existente.',
                                    'required' => 'Se debe seleccionar un comprador.'
                                ]),

                            Select::make('metodo_pago')
                                ->required()
                                ->options([
                                    'efectivo' => 'Efectivo',
                                    'tarjeta' => 'Tarjeta de crédito o débito',
                                    'par' => 'Pago al Recibir'
                                ])
                                ->native(false)
                                ->default('par')
                                ->validationMessages([
                                    'required' => 'Debe seleccionar un metodo de pago.',
                                    'options' => 'Debe seleccionar un metodo de pago valido.'
                                ]),

                            Select::make('estado_pago')
                                ->options([
                                    'pagado' => 'Pagado',
                                    'procesando' => 'Procesando',
                                    'error' => 'Error'
                                ])
                                ->default('procesando')
                                ->native(false)
                                ->required()
                                ->validationMessages([
                                    'options' => 'Debe seleccionar un metodo de pago valido.',
                                    'required' => 'Debe seleccionar un metodo de pago.',
                                ]),

                            ToggleButtons::make('estado_entrega')
                                ->options([
                                    'nuevo' => 'Nuevo',
                                    'procesado' => 'Procesando',
                                    'enviado' => 'Enviado',
                                    'entregado' => 'Entregado',
                                    'cancelado' => 'Cancelado'
                                ])
                                ->colors([
                                    'nuevo' => 'primary',
                                    'procesado' => 'warning',
                                    'enviado' => 'success',
                                    'entregado' => 'success',
                                    'cancelado' => 'danger'
                                ])
                                ->icons([
                                    'nuevo' => 'heroicon-m-sparkles',
                                    'procesado' => 'heroicon-m-arrow-path',
                                    'enviado' => 'heroicon-m-truck',
                                    'entregado' => 'heroicon-m-archive-box',
                                    'cancelado' => 'heroicon-m-x-circle'
                                ])
                                ->default('nuevo')
                                ->inline()
                                ->required()
                                ->validationMessages([
                                    'options' => 'Debe seleccionar un estado de entrega válido.',
                                    'required' => 'Debe seleccionar un estado de entrega.',
                                ]),
                        ])->columns(2),
                    ])->columns(2)->columnSpanFull(),
                ])->columnSpanFull(),

                Section::make('Detalles de Orden')
                    ->schema([
                        Repeater::make('elementos')
                            ->relationship()
                            ->schema([
                                Select::make('producto_id')
                                    ->preload()
                                    ->relationship('producto', 'nombre')
                                    ->searchable()
                                    ->required()
                                    ->distinct()
                                    ->reactive()
->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        $producto = Producto::find($state);

                                        if ($producto) {
                                            $precio = $producto->precio;
                                            $porcentajeDescuento = $producto->porcentaje_oferta / 100;
                                            $precioConDescuento = $precio - ($precio * $porcentajeDescuento);

                                            $set('monto_unitario', $precioConDescuento);
                                            $set('monto_total', $precioConDescuento * $get('cantidad'));

                                            // Mostrar hint si el producto está en oferta
                                            if ($producto->en_oferta) {
                                                $set('hint_monto_unitario', "L. " . number_format( $precio, 2));
                                            } else {
                                                $set('hint_monto_unitario', null);
                                            }
                                        }
                                    })
                                    ->validationMessages([
                                        'required' => 'Debe seleccionar un producto.',
                                    ])
                                    ->columnSpan(4),

                                TextInput::make('cantidad')
                                    ->numeric()
                                    ->required()
                                    ->default(1)
                                    ->minValue(1)
                                    ->columnSpan(2)
                                    ->reactive()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        $set('monto_total', $state * $get('monto_unitario'));
                                    })->columns(3)
                                    ->required()
                                    ->validationMessages([
                                        'required' => 'Debe introducir una cantidad',
                                        'min_value' => 'La cantidad mínima permitida es 1'
                                    ]),

                                TextInput::make('monto_unitario')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->label('Monto Unitario')
                                    ->hint(fn(Get $get) => $get('hint_monto_unitario')) // Mostrar el hint con el precio original tachado
                                    ->reactive()
                                    ->validationMessages([
                                        'disabled' => 'El campo no puede ser deshabilitado',
                                        'numeric' => 'El valor ingresado debe ser un número',
                                        'required' => 'Debe introducir una cantidad',
                                        'min_value' => 'La cantidad mínima permitida es 1'
                                    ])
                                    ->columnSpan(3),

                                TextInput::make('monto_total')
                                    ->numeric()
                                    ->disabled()
                                    ->required()
                                    ->dehydrated()
                                    ->reactive()
                                    ->step(0.01)
                                    ->columnSpan(3)
                                    ->extraAttributes([
                                        'step' => '0.01'
                                    ])
                                    ->validationMessages([
                                        'disabled' => 'El campo no puede ser deshabilitado',
                                        'numeric' => 'El valor ingresado debe ser un número',
                                        'required' => 'Debe introducir una cantidad',
                                        'min_value' => 'La cantidad mínima permitida es 1'
                                    ])->columns(2),


                            ])->columns(12),

                        Section::make([
                            MarkdownEditor::make('notas')
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
                                ->columnSpanFull(),
                        ]),

                        Section::make([

                            Placeholder::make('total_final_placeholder')
                                ->label('Total Final: ')
                                ->content(function (Get $get, Set $set) {
                                    $total = 0;
                                    if (!$repeaters = $get('elementos')) {
                                        return $total;
                                    }

                                    foreach ($repeaters as $key => $repeater) {
                                        $total += $get("elementos.{$key}.monto_total");
                                    }

                                    return $set('total_final', $total);
                                }),

                            Hidden::make('total_final')
                                ->default(0),

                            Hidden::make('costos_envio')
                                ->default(0),

                            Placeholder::make('porcentaje_oferta_placeholder')
                                ->label('Descuentos: ')
                                ->content(function (Get $get, Set $set) {
                                    $total = 0;
                                    if (!$repeaters = $get('elementos')) {
                                        return $total;
                                    }

                                    foreach ($repeaters as $key => $repeater) {
                                        $total += $get("elementos.{$key}.porcentaje_oferta");
                                    }
                                    $set('porcentaje_oferta', $total);
                                }),


                            Placeholder::make('created_at')
                                ->label('Fecha de Creación')
                                ->content(fn(?Orden $record): string => $record?->created_at?->diffForHumans() ?? '-')
                                ->columnSpan(1),

                            Placeholder::make('updated_at')
                                ->label('Última Modificación')
                                ->content(fn(?Orden $record): string => $record?->updated_at?->diffForHumans() ?? '-')
                                ->columnSpan(1),
                        ])->columns(3),/*Fin de seccion*/
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Comprador')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('total_final')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('metodo_pago')
                    ->searchable()
                    ->sortable(),

                SelectColumn::make('estado_pago')
                    ->options([
                        'pagado' => 'Pagado',
                        'procesando' => 'Procesando',
                        'error' => 'Error'
                    ])
                    ->searchable()
                    ->sortable(),

                SelectColumn::make('estado_entrega')
                    ->options([
                        'nuevo' => 'Nuevo',
                        'procesado' => 'En Proceso',
                        'enviado' => 'Enviado',
                        'entregado' => 'Entregado',
                        'cancelado' => 'Cancelado',
                    ])
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrdenes::route('/'),
            'create' => Pages\CreateOrden::route('/create'),
            'edit' => Pages\EditOrden::route('/{record}/edit'),
            'view' => Pages\ViewOrden::route('/{record}/view')
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['user']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['user.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->user) {
            $details['User'] = $record->user->name;
        }

        return $details;
    }

    public static function getRelations(): array
    {
        return [
            DireccionRelationManager::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return self::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return self::getModel()::count() > 5 ? 'success' : 'danger';
    }


}
