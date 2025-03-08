<?php

namespace App\Filament\Resources\SubjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherSubjectRelationManager extends RelationManager
{
    protected static string $relationship = 'TeacherSubject';


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ptk_id')
                    ->relationship('teacher', 'nama')
                    ->searchable()
                    ->live()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        // dd($table->recordTitleAttribute('ptk_id'));
        return $table
            ->recordTitleAttribute('ptk_id')
            ->columns([
                Tables\Columns\TextColumn::make('teacher.nama')->searchable()->label('Nama Guru'),
                Tables\Columns\TextColumn::make('teacher.jenis_kelamin')->label('Jenis Kelamin'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add Teacher'),
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
}
