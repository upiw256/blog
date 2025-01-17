<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExtracurricularActivityResource\Pages;
use App\Filament\Resources\ExtracurricularActivityResource\RelationManagers;
use App\Models\ExtracurricularActivity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExtracurricularActivityResource extends Resource
{
    protected static ?string $model = ExtracurricularActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Master';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(65535),


                Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->avatar()
                    ->directory('extracurricular')
                    ->disk('public')
                    ->maxSize(1028)
                    ->imageEditor()
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg'])
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\ImageColumn::make('logo')->label('Logo'),
                Tables\Columns\TextColumn::make('description')->limit(50)->html(),

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
                ])->label('Delete'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MemberExtraRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExtracurricularActivities::route('/'),
            'create' => Pages\CreateExtracurricularActivity::route('/create'),
            'edit' => Pages\EditExtracurricularActivity::route('/{record}/edit'),
        ];
    }
}
