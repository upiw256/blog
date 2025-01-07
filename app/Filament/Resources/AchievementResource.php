<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Filament\Resources\AchievementResource\RelationManagers;
use App\Models\achievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AchievementResource extends Resource
{

    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        $currentYear = date('Y');
        $years = range(2006, $currentYear);
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nama Kejuaran')
                    ->maxLength(255),
                Forms\Components\Select::make('category')
                    ->required()
                    ->options([
                        'Academic' => 'Academic',
                        'non-academic' => 'Non Academic',
                    ]),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpan(2),
                Forms\Components\FileUpload::make('img')
                    ->image()
                    ->disk('public')
                    ->directory('achivements')
                    ->imageEditor()
                    ->columnSpan(2)
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg'])
                    ->maxSize(1024),
                Forms\Components\Select::make('level')
                    ->required()
                    ->options([
                        'Sekolah' => 'Sekolah',
                        'Kecamatan' => 'Kecamatan',
                        'Kabupaten' => 'Kabupaten',
                        'Provinsi' => 'Provinsi',
                        'Nasional' => 'Nasional',
                        'Internasional' => 'Internasional',
                    ]),
                Forms\Components\Select::make('champion_to')
                    ->required()
                    ->options([
                        'Satu' => 'Satu',
                        'Dua' => 'Dua',
                        'Tiga' => 'Tiga',
                        'Harapan satu' => 'Harapan satu',
                        'Harapan dua' => 'Harapan dua',
                        'Harapan tiga' => 'Harapan tiga',

                    ]),
                Forms\Components\Select::make('year')
                    ->required()
                    ->default($currentYear)
                    ->searchable()
                    ->options($years),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('description')->html(),
                Tables\Columns\TextColumn::make('level'),
                Tables\Columns\TextColumn::make('champion_to'),
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

            RelationManagers\StudentRelationManager::class,
            RelationManagers\AchievementImgRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}
