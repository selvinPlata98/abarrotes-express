<?php

namespace App\Filament\Resources;
use App\Models\Marca;
use Filament\Forms;
use Filament\Forms\Form;
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

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $activeNavigationIcon = 'heroicon-s-collection';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form

    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->label('Nombre')
                    ->maxLength(255),

                Forms\Components\TextInput::make('enlace')
                    ->required()
                    ->label('Enlace')
                    ->maxLength(255)
                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                        if ($operation === 'create') {
                            $set('enlace', Str::slug($state));
                        }
                    }),

                Forms\Components\FileUpload::make('imagen')
                    ->required()
                    ->label('Imagen')
                    ->image()
                    ->maxFiles(1)
                    ->columnSpan(2),

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
            'index' => Pages\ListMarcas::route('/'),
            'create' => Pages\CreateMarca::route('/create'),
            'edit' => Pages\EditMarca::route('/{record}/edit'),
            'view' =>MarcaResource\Pages\ViewMarcas::route('/{record}/view')
        ];
    }
}
