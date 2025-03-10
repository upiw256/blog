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
                    ->label('Student ID')
                    ->options(Student::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('class_name')
                    ->required()
                    ->label('Class Name'),
                Forms\Components\Select::make('information')
                    ->options([
                        'passed' => 'Passed',
                        'not passed' => 'Not Passed',
                    ])
                    ->required()
                    ->label('Graduation Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.nama')
                    ->label('Student Name'),
                Tables\Columns\TextColumn::make('student.nama_rombel')
                    ->label('Class Name'),
                Tables\Columns\ToggleColumn::make('information')
                    ->label('Graduation Status')
                    ->beforeStateUpdated(function ($state) {
                        return $state === 'passed' ? 'Passed' : 'Not Passed';
                    }),
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
            'index' => Pages\ListGraduations::route('/'),
            'create' => Pages\CreateGraduation::route('/create'),
            'edit' => Pages\EditGraduation::route('/{record}/edit'),
        ];
    }
}
