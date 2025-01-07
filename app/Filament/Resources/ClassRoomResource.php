<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassRoomResource\Pages;
use App\Filament\Resources\ClassRoomResource\RelationManagers;
use App\Models\ClassRoom;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClassRoomResource extends Resource
{
    protected static ?string $model = ClassRoom::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Dapodik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Kelas')
                    ->readOnly()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('tingkat_pendidikan_id_str')->label('Tingkat'),
                Tables\Columns\TextColumn::make('kurikulum_id_str')->label('Kurikulum'),
                Tables\Columns\TextColumn::make('ptk_id_str')->label('Wali Kelas'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Data Diri - Perubahan data lakukan di aplikasi dapodik')->schema([
                    Split::make([
                        Grid::make(2)
                            ->schema([
                                Group::make([
                                    TextEntry::make('nama')->label('Nama :'),
                                    TextEntry::make('tingkat_pendidikan_id_str')->label('Angkatan :'),
                                    TextEntry::make('jenis_rombel_str')->label('Jenis :'),
                                    TextEntry::make('kurikulum_id_str')->label('Kurikulum :'),
                                ]),
                                Group::make([
                                    TextEntry::make('id_ruang_str')->label('Ruangan :'),
                                    TextEntry::make('moving_class')->label('Moving Class :'),
                                    TextEntry::make('ptk_id_str')->label('Walikelas :'),
                                    TextEntry::make('jurusan_id_str')->label('Jurusan :'),
                                ]),
                            ])
                    ]),

                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ScheduleRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ClassRoom::route('/'),
            'create' => Pages\CreateClassRoom::route('/create'),
            'edit' => Pages\EditClassRoom::route('/{record}/edit'),
        ];
    }
}
