<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StafResource\Pages;
use App\Filament\Resources\StafResource\RelationManagers;
use App\Models\staf;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StafResource extends Resource
{
    protected static ?string $model = Staf::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string $relationship = 'teacher';
    protected static ?string $navigationGroup = 'Master';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('teacher_id')
                    ->label('Teachers')
                    ->searchable()
                    ->live()
                    ->relationship('teacher', 'nama')
                    ->required(),
                Forms\Components\Select::make('jabatan')
                    ->label('Jabatan')
                    ->options([
                        'wakasek sarana' => 'Wakasek Sarana',
                        'wakasek humas' => 'Wakasek Humas',
                        'wakasek kesiswaan' => 'Wakasek Kesiswaan',
                        'wakasek kurikulum' => 'Wakasek Kurikulum',
                        'staf wakasek sarana' => 'Staf Wakasek Sarana',
                        'staf wakasek humas' => 'Staf Wakasek Humas',
                        'staf wakasek kesiswaan' => 'Staf Wakasek Kesiswaan',
                        'staf wakasek kurikulum' => 'Staf Wakasek Kurikulum',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('img')
                    ->image()
                    ->required()
                    ->label('Image')
                    ->maxSize(1024)
                    ->directory('wakasek')
                    ->imageResizeMode('cover')
                    ->imageResizeTargetWidth('720')
                    ->imageResizeTargetHeight('480')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('teacher_id')
            ->columns([
                Tables\Columns\TextColumn::make('teacher.nama')->searchable(),
                Tables\Columns\TextColumn::make('teacher.nip')->searchable(),
                Tables\Columns\TextColumn::make('jabatan')->searchable(),
                Tables\Columns\ImageColumn::make('img'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListStafs::route('/'),
            'create' => Pages\CreateStaf::route('/create'),
            'edit' => Pages\EditStaf::route('/{record}/edit'),
        ];
    }
}
