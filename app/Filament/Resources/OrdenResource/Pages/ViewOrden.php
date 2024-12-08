<?php

namespace App\Filament\Resources\OrdenResource\Pages;

use App\Filament\Resources\OrdenResource;
use App\Models\Orden;
use App\Models\Producto;
use Filament\Actions;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\ViewRecord;

class ViewOrden extends ViewRecord
{
    protected static string $resource = OrdenResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    Section::make([
                        Section::make([
                            Select::make('user_id')
                                ->relationship('user', 'name')
                                ->label('Usuario')
                                ->searchable()
                                ->required(),

                            Select::make('metodo_pago')
                                ->required()
                                ->options([
                                    'efectivo' => 'Efectivo',
                                    'tarjeta' => 'Tarjeta de crédito o débito',
                                    'par' => 'Pago al Recibir'
                                ])
                                ->native(false),

                            Select::make('estado_pago')
                                ->options([
                                    'pagado' => 'Pagado',
                                    'procesando' => 'Procesando',
                                    'error' => 'Error'
                                ])
                                ->native(false)
                                ->required(),

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
                                ->required(),
                        ])->columns(2),



                    ])->columns(2)->columnSpanFull(),
                ])->columnSpanFull(),

                Section::make('Detalles de Orden')
                    ->schema([
                        Repeater::make('elementos')
                            ->relationship()
                            ->schema([
                                Select::make('producto_id')
                                    ->relationship('producto', 'nombre')
                                    ->searchable()
                                    ->required()
                                    ->distinct()
                                    ->reactive()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        $producto = Producto::find($state);
                                        $set('monto_unitario', $producto ? $producto->precio : 0);
                                        $set('monto_total', ($producto ? $producto->precio : 0) * $get('cantidad'));
                                        $set('porcentaje_oferta', ($producto ? $producto->precio : 0) * $get('porcentaje_oferta'));
                                    })
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
                                    })
                                    ->validationMessages([
                                        'required' => 'Debe introducir una cantidad',
                                    ]),

                                TextInput::make('monto_unitario')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
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
                                    ]),


                            ])->columns(12),

                        Section::make([
                            MarkdownEditor::make('notas')
                                ->required()
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

    protected function getHeaderActions(): array
    {
        return [
          Actions\EditAction::make(),
            Actions\DeleteAction::make()
        ];
    }
}
