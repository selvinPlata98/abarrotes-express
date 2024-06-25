<?php

namespace App\Filament\Resources\MarcaResource\Pages;

use App\Filament\Resources\MarcaResource\Pages;
use App\Filament\Resources\MarcaResource;
use Filament\Actions;
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
            Actions\EditAction::make()
        ];
    }

    public  function form(Form $form): Form

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
                    ->disk('ftp')
                    ->directory('productos')
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
}
