<?php

namespace App\Filament\Resources\OrdenResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DireccionRelationManager extends RelationManager
{
    protected static string $relationship = 'Direccion';
    protected static bool $canCreateAnother = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombres')
                    ->required()
                    ->maxLength(100)
                    ->regex('/^[A-Za-z ]+$/')
                    ->validationMessages([
                            'required' => 'Introduzca un nombre.',
                            'regex' => 'No introducir números o caracteres especiales.'
                        ]
                    ),

                TextInput::make('apellidos')
                    ->required()
                    ->maxLength(100)
                    ->regex('/^[A-Za-z ]+$/')
                    ->validationMessages([
                            'required' => 'Introduzca un apellido.',
                            'regex' => 'No introducir números o caracteres especiales.'
                        ]
                    ),

                TextInput::make('telefono')
                    ->required()
                    ->tel()
                    ->maxLength(8)
                    ->validationMessages([
                            'required' => 'Introduzca un número telefónico.',
                            'tel' => 'Debe Introducir un número telefónico.',
                            'maxLength' => 'El número telefónico puede contener máximo 8 dígitos.'
                        ]
                    ),


                Select::make('departamento')
                    ->options($this->getDepartamentos())
                    ->afterStateUpdated(fn (callable $set, $state) => $set('departamento', null))
                    ->native(false)
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->validationMessages([
                        'options' => 'El departamento debe estar en la lista',
                        'required' => 'Debe seleccionar un departamento.'
                    ]),

                Select::make('municipio')
                    ->options(function (callable $get) {
                        $departamento = $get('departamento');
                        if ($departamento) {
                            return $this->getMunicipios($departamento);
                        }
                        return [];
                    })
                    ->searchable()
                    ->native(false)
                    ->required()
                    ->validationMessages([
                        'options' => 'El municipio debe estar en la lista',
                        'required' => 'Debe seleccionar un municipio.'
                    ]),


                TextInput::make('ciudad')
                    ->required()
                    ->maxLength(255)
                    ->label('Ciudad')
                    ->validationMessages([
                        'maxLength' => 'La ciudad no debe superar los 255 caracteres.',
                        'required' => 'Debe introducir una ciudad.'
                    ]),

                Textarea::make('direccion_completa')
                    ->required()
                    ->maxLength(500)
                    ->columnSpanFull()
                    ->validationMessages([
                        'maxLength' => 'La ciudad no debe superar los 500 caracteres.',
                        'required' => 'Debe introducir una dirección.'
                    ]),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('direccion_completa')
            ->columns([
                TextColumn::make('nombre_completo')
                    ->getStateUsing(function ($record) {
                        return $record->nombres . ' ' . $record->apellidos;
                    })
                    ->label('Nombre Completo'),
                TextColumn::make('telefono'),
                TextColumn::make('departamento'),
                TextColumn::make('municipio'),
                TextColumn::make('ciudad'),
                TextColumn::make('direccion')
                ->limit(50),
            ])
            ->paginated(false)
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public function getDepartamentos(): array
    {
        $data = file_get_contents(resource_path('assets/departamentos.json'));
        return json_decode($data, true);
    }

    public function getMunicipios($departamento): array
    {
        $municipiosData = file_get_contents(resource_path('assets/municipios.json'));
        $municipios = json_decode($municipiosData, true);

        return $municipios[$departamento] ?? [];
    }
}
