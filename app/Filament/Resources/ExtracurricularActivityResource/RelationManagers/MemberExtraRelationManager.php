<?php

namespace App\Filament\Resources\ExtracurricularActivityResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberExtraRelationManager extends RelationManager
{
    protected static string $relationship = 'member_extra';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Student')
                    ->unique()
                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                    ->searchable()
                    ->live()
                    ->relationship('student', 'nama')
                    ->required()
            ]);
    }

    public function table(Table $table): Table
    {

        return $table
            ->recordTitleAttribute('student_id')
            ->columns([
                Tables\Columns\TextColumn::make('student.nama'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add Member'),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
