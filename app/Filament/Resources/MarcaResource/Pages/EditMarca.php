<?php

namespace App\Filament\Resources\MarcaResource\Pages;

use App\Filament\Resources\MarcaResource;
use App\Models\Marca;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditMarca extends EditRecord
{
    protected static string $resource = MarcaResource::class;

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
               TextInput::make('nombre')
                    ->required()
                    ->label('Nombre De la Marca')
                    ->maxLength(80)
                    ->regex('/^[A-Za-z ]+$/')
                    ->unique(Marca::class, ignoreRecord: true)
                    ->validationMessages([
                        'maxLenght' => 'El nombre debe  contener un maximo de 80 carácteres.',
                        'required' => 'Debe introducir un nombre de la marca',
                        'unique' => 'Esta Marca ya existe'
                    ])
                    ->afterStateUpdated(fn(string $operation, $state, Set $set) => $set('enlace', Str::slug($state)))
                    ->reactive()
                    ->live(onBlur: true)
                    ->unique(Marca::class, ignoreRecord: true)
                    ->maxLength(255),

               TextInput::make('enlace')
                    ->required()
                    ->label('Enlace')
                    ->disabled()
                    ->dehydrated()
                    ->maxLength(255)
                    ->validationMessages([
                        'unique' => 'Este enlace ya existe'
                    ]),

               FileUpload::make('imagen')
                    ->required()
                    ->label('Imagen')
                    ->image()
                    ->directory('marcas')
                    ->validationMessages([
                        'maxFiles' => 'Se permite un máximo de 1 imágenes.',
                        'required' => 'Debe seleccionar al menos una imagen.',
                        'image' => 'El archivo debe ser una imagen válida.',
                    ])
                    ->maxFiles(1)
                    ->columnSpan(2)
                    ->preserveFilenames()
                    ->maxFiles(1)
                    ->columnSpan(2),

               Toggle::make('disponible')
                    ->label('Disponible')
                    ->default(true),

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
            ]);
    }
}
