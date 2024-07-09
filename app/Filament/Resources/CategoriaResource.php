<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Filament\Resources\CategoriaResource\RelationManagers;
use App\Models\Categoria;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;

class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;
    protected static ?string $navigationGroup = 'Productos';

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $activeNavigationIcon = 'heroicon-s-queue-list';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(components: [

                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->label('Nombre De la MostrarCategoria')
                    ->maxLength(80)
                    ->regex('/^[A-Za-z ]+$/')
                    ->validationMessages([
                        'maxLenght' => 'El nombre debe  contener un maximo de 80 carácteres.',
                        'required' => 'Debe introducir un nombre de la marca',
                        'regex' => 'El nombre solo debe contener letras y espacios.',
                        'unique' => 'Esta categoría ya existe.',
                    ])
                    ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation
                    === 'create' ? $set('enlace', Str::slug($state)) : null)
                    ->reactive()
                    ->live(onBlur: true)
                    ->unique(Categoria::class, ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('enlace')
                    ->required()
                    ->label('Enlace')
                    ->disabled()
                    ->dehydrated()
                    ->unique(Categoria::class, ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Este enlace ya existe'
                    ]),

                FileUpload::make('imagen')
                    ->required()
                    ->label('Imagen')
                    ->image()
                    ->visibility('public')
                    ->directory('categorias')
                    ->validationMessages([
                        'maxFiles' => 'Se permite un máximo de 1 imágenes.',
                        'required' => 'Debe seleccionar al menos una imagen.',
                        'image' => 'El archivo debe ser una imagen válida.',
                    ])
                    ->maxFiles(1)
                    ->columnSpan(2)
                    ->preserveFilenames(),

                Forms\Components\Toggle::make('disponible')
                    ->label('Disponible')
                    ->default(true),

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
            'index' => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'edit' => Pages\EditCategoria::route('/{record}/edit'),
            'view' =>Pages\ViewCategoria::route('/{record}/view')
        ];
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['nombre', 'imagen'];
    }
}
