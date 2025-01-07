<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Filament\Resources\SubjectResource\RelationManagers;
use App\Models\Subject;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $relationship = 'teacher';
    protected static ?string $navigationGroup = 'Master';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                forms\Components\TextInput::make("kode_subject")
                    ->label("Kode Mata Pelajaran")
                    ->required(),
                forms\Components\TextInput::make("name")
                    ->label("Nama Mata Pelajaran")
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")
                    ->label("Mata Pelajaran"),
                Tables\Columns\TextColumn::make("kode_subject")
                    ->label("Kode Mata Pelajaran"),
                Tables\Columns\TextColumn::make('teachers.nama')
                    ->badge()
                    ->label('Guru Yang Mengajar')
                    ->listWithLineBreaks()
                    ->color(fn() => ['warning', 'success', 'info'][rand(0, 2)])
                    ->formatStateUsing(fn($state) => $state ?? 'Belum ada guru'),
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
            RelationManagers\TeacherSubjectRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return Subject::query()->with('teachers');
    }
}
