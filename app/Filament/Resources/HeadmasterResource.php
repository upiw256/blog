<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeadmasterResource\Pages;
use App\Filament\Resources\HeadmasterResource\RelationManagers;
use App\Models\headmaster;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HeadmasterResource extends Resource
{
    protected static ?string $model = headmaster::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('teacher_id')
                    ->label('Pilih Guru')
                    ->searchable()
                    ->live()
                    ->relationship('teacher', 'nama')
                    ->required(),
                Forms\Components\RichEditor::make("performance")
                    ->label("Prestasi yang pernah diraih")
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\TextInput::make("front_title")
                    ->label("Gelar Depan"),
                Forms\Components\TextInput::make("back_title")
                    ->label("Gelar Belakang"),
                Forms\Components\FileUpload::make("image")
                    ->image()
                    ->disk('public')
                    ->directory('kepsek')
                    ->imageEditor()
                    ->nullable()
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg'])
                    ->required()
                    ->maxSize(1024),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListHeadmasters::route('/'),
            'create' => Pages\CreateHeadmaster::route('/create'),
            'edit' => Pages\EditHeadmaster::route('/{record}/edit'),
        ];
    }
}
