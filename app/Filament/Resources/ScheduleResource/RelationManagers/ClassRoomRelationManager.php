<?php

namespace App\Filament\Resources\ScheduleResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClassRoomRelationManager extends RelationManager
{
    protected static string $relationship = 'classRoom'; // Menggunakan penamaan relasi sesuai Eloquent
    protected static ?string $title = 'Class Room';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama') // Nama kolom yang benar
                    ->label('Class Room Name')
                    ->required()
                    ->maxLength(191),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Class Room Name'),
            ])
            ->filters([
                // Tambahkan filter sesuai kebutuhan
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
