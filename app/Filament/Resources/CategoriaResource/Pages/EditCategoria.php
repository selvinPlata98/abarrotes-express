<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use App\Models\Categoria;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;
use App\Filament\Resources\CategoriaResource\Pages;
use App\Filament\Resources\CategoriaResource\RelationManagers;
use App\Models\Producto;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;

class EditCategoria extends EditRecord
{
    protected static string $resource = CategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public  function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->label('Nombre De la Categoria')
                    ->maxLength(70)
                    ->regex('/^[A-Za-zÀ-ÿ0-9\s\-\'\.]+$/')
                    ->unique(Categoria::class, ignoreRecord: true)
                    ->autocomplete('off')
                    ->validationMessages([
                        'maxLength' => 'El nombre debe contener un máximo de :max caracteres.',
                        'required' => 'Debe introducir un nombre para la categoría.',
                        'regex' => 'El nombre solo debe contener letras y espacios.',
                        'unique' => 'Esta categoría ya existe.',
                    ])->columnSpanFull(),

                FileUpload::make('imagen')
                    ->required()
                    ->label('Imagen')
                    ->image()
                    ->directory('categorias')
                    ->imageEditor()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->maxFiles(1)
                    ->maxSize(5190)
                    ->preserveFilenames()
                    ->columnSpanFull()
                    ->validationMessages([
                        'maxFiles' => 'Se permite un máximo de 1 imagen.',
                        'required' => 'Debe seleccionar al menos una imagen.',
                        'image' => 'El archivo debe ser una imagen válida.',
                        'max' => 'El tamaño de la imagen no debe exceder los 5MB.',
                    ]),

                Forms\Components\Toggle::make('disponible')
                    ->label('Disponible')
                    ->default(true)
                    ->rules(['boolean'])
                    ->validationMessages([
                        'boolean' => 'El valor debe ser verdadero o falso.',
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
                        'undo',
                    ])
                    ->minLength(10)
                    ->maxLength(200)
                    ->validationMessages([
                        'required' => 'La descripción es obligatoria.',
                        'minLength' => 'La descripción debe tener al menos :min caracteres.',
                        'maxLength' => 'La descripción no puede exceder los :max caracteres.',
                    ])
                    ->columnSpan(2),
            ]);
    }

    public function getRedirectUrl(): ?string
    {

        $recordId = $this->record?->id;


        if ($recordId) {
            $url = $this->getResource()::getUrl('view', ['record' => $recordId]) . '?sort=-created_at&tableSortColumn=id&tableSortDirection=desc';
            return $url;
        }

        return null;
    }
}
