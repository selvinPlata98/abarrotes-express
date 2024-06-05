<?php

namespace App\Filament\Resources;

    use App\Filament\Resources\UsuariosResource\Pages;
    use App\Models\User;
    use Filament\Forms\Components\DatePicker;
    use Filament\Forms\Components\Placeholder;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables\Actions\BulkActionGroup;
    use Filament\Tables\Actions\DeleteAction;
    use Filament\Tables\Actions\DeleteBulkAction;
    use Filament\Tables\Actions\EditAction;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Tables\Table;

    class UsuariosResource extends Resource {
        protected static ?string $model = User::class;

        protected static ?string $slug = 'usuarios';

        protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

        public static function form(Form $form): Form
        {
        return $form
        ->schema([//
        TextInput::make('name')
        ->required(),

        TextInput::make('email')
        ->required(),

        DatePicker::make('email_verified_at')
        ->label('Email Verified Date'),

        TextInput::make('password')
        ->required(),

        TextInput::make('rol_id')
        ->required()
        ->integer(),

        Placeholder::make('created_at')
        ->label('Created Date')
        ->content(fn (?User $record): string => $record?->created_at?->diffForHumans() ?? '-'),

        Placeholder::make('updated_at')
        ->label('Last Modified Date')
        ->content(fn (?User $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
        ]);
        }

        public static function table(Table $table): Table
        {
        return $table
        ->columns([
        TextColumn::make('name')
        ->searchable()
        ->sortable(),

        TextColumn::make('email')
        ->searchable()
        ->sortable(),

        TextColumn::make('email_verified_at')
        ->label('Email Verified Date')
        ->date(),

        TextColumn::make('rol_id'),
        ])
        ->filters([
        //
        ])
        ->actions([
        EditAction::make(),
        DeleteAction::make(),
        ])
        ->bulkActions([
        BulkActionGroup::make([
        DeleteBulkAction::make(),
        ]),
        ]);
        }

        public static function getPages(): array
        {
        return [
        'index' => Pages\ListUsuarios::route('/'),
'create' => Pages\CreateUsuarios::route('/create'),
'edit' => Pages\EditUsuarios::route('/{record}/edit'),
        ];
        }

        public static function getGloballySearchableAttributes(): array
        {
        return ['name', 'email'];
        }
    }
