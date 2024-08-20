<?php

namespace App\Filament\Resources;
use App\Filament\Resources\MarcaResource\Pages\CreateMarca;
use App\Filament\Resources\MarcaResource\Pages\EditMarca;
use App\Filament\Resources\MarcaResource\Pages\ListMarcas;
use App\Filament\Resources\MarcaResource\Pages\ViewMarca;
use App\Models\Marca;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
class MarcaResource extends Resource
{
    protected static ?string $model = Marca::class;
    protected static ?string $navigationGroup = 'Productos';
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $activeNavigationIcon = 'heroicon-s-cube';
    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->label('Nombre De la Marca')
                    ->maxLength(70)
                    ->regex('/^[A-Za-zÀ-ÿ0-9\s\-\'\.]+$/')
                    ->unique(Marca::class, ignoreRecord: true)
                    ->autocomplete('off')
                    ->validationMessages([
                        'maxLength' => 'El nombre debe contener un máximo de :max caracteres.',
                        'required' => 'Debe introducir un nombre para la marca.',
                        'regex' => 'El nombre solo puede contener letras, números y los caracteres especiales permitidos.',
                        'unique' => 'Esta marca ya existe.',
                    ]),

                Forms\Components\FileUpload::make('imagen')
                    ->required()
                    ->label('Imagen')
                    ->image()
                    ->directory('marcas')
                    ->imageEditor()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->maxFiles(1)
                    ->maxSize(5190)
                    ->preserveFilenames()
                    ->validationMessages([
                        'maxFiles' => 'Se permite un máximo de 1 imagen.',
                        'required' => 'Debe seleccionar al menos una imagen.',
                        'image' => 'El archivo debe ser una imagen válida.',
                        'max' => 'El tamaño de la imagen no debe exceder los 5MB.',
                    ])
                    ->columnSpan(2),

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






    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMarcas::route('/'),
            'create' => CreateMarca::route('/create'),
            'edit' => EditMarca::route('/{record}/edit'),
            'view' => ViewMarca::route('/{record}/view')
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nombre', 'enlace'];
    }
}
