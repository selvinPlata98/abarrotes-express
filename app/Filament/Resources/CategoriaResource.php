<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Filament\Resources\CategoriaResource\RelationManagers;
use App\Models\Categoria;
use Filament\Forms;
<<<<<<< HEAD
use Filament\Forms\Form;
use Filament\Resources\Resource;
=======
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
>>>>>>> s_plata
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
<<<<<<< HEAD
=======
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
>>>>>>> s_plata

class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $activeNavigationIcon = 'heroicon-s-queue-list';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
<<<<<<< HEAD
            ->schema([
                //
=======
            ->schema(components: [

                TextInput::make('nombre')
                ->required()
                ->label('Nombre de la Categoria')
                    ->maxLength(80)
                    ->regex('/^[A-Za-z ]+$/')
                    ->validationMessages([
                        'maxLenght' => 'El nombre no debe contener más de 80 carácteres.',
                       'required' => 'Debe introducir el nombre de la Categoria.',
                        'regex' => 'La categoria solo debe contener letras y espacios.'
                    ]),

                TextInput::make('enlace')
                ->required(),

                FileUpload ::make('imagen'),

                Select::make('disponible')
                    ->options([
                        1=>'Disponible',
                        0=>'No Disponible'
                    ])->required()
                    ->label('Estado'),

>>>>>>> s_plata
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
<<<<<<< HEAD
                //
=======
                TextColumn::make('nombre')
                ->searchable()
                    ->sortable()
                    ->label('Categoria'),


                        TextColumn::make('imagen')
                        ->searchable()
                            ->sortable()
                            ->label('Imagen'),

>>>>>>> s_plata
            ])
            ->filters([
                //
            ])
            ->actions([
<<<<<<< HEAD
                Tables\Actions\EditAction::make(),
=======
                ActionGroup::make([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                ])
>>>>>>> s_plata
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'edit' => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }
<<<<<<< HEAD
=======
    public static function getGloballySearchableAttributes(): array
    {
        return ['nombre', 'imagen'];
    }
>>>>>>> s_plata
}
