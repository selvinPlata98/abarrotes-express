<?php

namespace App\Filament\Resources\MarcaResource\Pages;

use App\Filament\Resources\MarcaResource\Pages;
use App\Filament\Resources\MarcaResource;
use Filament\Actions;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\MarcaResource\RelationManagers;
use App\Models\Marca;
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
class ViewMarca extends ViewRecord
{
    protected static string $resource = MarcaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public  function form(Form $form): Form

    {

        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->label('Nombre De la Marca')
                    ->maxLength(80)
                    ->regex('/^[A-Za-z ]+$/')
                    ->unique(Marca::class, ignoreRecord: true)
                    ->validationMessages([
                        'maxLength' => 'El nombre debe contener un máximo de 80 caracteres.',
                        'required' => 'Debe introducir un nombre de la marca',
                        'unique' => 'Esta Marca ya existe',
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
                    ->unique(Marca::class, ignoreRecord: true),

                Forms\Components\FileUpload::make('imagen')
                    ->required()
                    ->label('Imagen')
                    ->image()
                    ->disk('public')
                    ->directory('marcas')
                    ->validationMessages([
                        'maxFiles' => 'Se permite un máximo de 1 imagen.',
                        'required' => 'Debe seleccionar al menos una imagen.',
                        'image' => 'El archivo debe ser una imagen válida.',
                    ])
                    ->maxFiles(1)
                    ->columnSpan(2),

                Forms\Components\Toggle::make('disponible')
                    ->label('Disponible')
                    ->default(true),

                Forms\Components\MarkdownEditor::make('descripcion')
                    ->required()
                    ->label('Descripción')
                    ->toolbarButtons([
                        'bold',
                        'bulletList',
                        'heading',
                        'italic',
                        'link',
                        'redo',
                        'undo',
                    ])
                    ->maxLength(182)
                    ->validationMessages([
                        'required' => 'La descripción es obligatoria.',
                        'maxLength' => 'La descripción no puede exceder los 182 caracteres.',
                    ])
                    ->columnSpan(2),
            ]);
    }
}
