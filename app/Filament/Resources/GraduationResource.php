<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GraduationResource\Pages;
use App\Filament\Resources\GraduationResource\RelationManagers;
use App\Models\Graduation;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GraduationResource extends Resource
{
    protected static ?string $model = Graduation::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Student Name')
                    ->options(Student::all()->pluck('nama', 'id')->toArray()) // Ensure valid options
                    ->searchable()
                    ->disabled(),
                Forms\Components\Placeholder::make('student_class')
                    ->label('Class Name')
                    ->content(fn ($record) => $record->student->nama_rombel ?? '-'),
                Forms\Components\Select::make('information')
                    ->label('Graduation Status')
                    ->options([
                        true => 'Passed',
                        false => 'Not Passed',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.nama')
                    ->label('Student Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('student.nama_rombel')
                    ->label('Class Name')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('information')
                    ->label('Kelulusan'),
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
            RelationManagers\SubjectGradesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGraduations::route('/'),
            'create' => Pages\CreateGraduation::route('/create'),
            'edit' => Pages\EditGraduation::route('/{record}/edit'),
        ];
    }
}
