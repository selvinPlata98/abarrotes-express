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
                    ->maxLength(80)
                    ->regex('/^[A-Za-z ]+$/')
                    ->unique(Marca::class, ignoreRecord: true)
                    ->validationMessages([
                        'maxLenght' => 'El nombre debe  contener un maximo de 80 carácteres.',
                        'required' => 'Debe introducir un nombre de la marca',
                        'unique' => 'Esta Marca ya existe'
                    ])
                    ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation
                    === 'create' ? $set('enlace', Str::slug($state)) : null)
                    ->reactive()
                    ->live(onBlur: true)
                    ->unique(Marca::class, ignoreRecord: true)
                    ->maxLength(255),

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
                    ->visibility('public')
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

                Forms\Components\Toggle::make('disponible')
                    ->label('Disponible')
                    ->default(true),

                Forms\Components\MarkdownEditor::make('descripcion')
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
