<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherResource extends Resource
{

    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Dapodik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nuptk')->label('NUPTK'),
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('bidang_studi_terakhir'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Data Diri - Perubahan data lakukan di aplikasi dapodik')->schema([
                    TextEntry::make('nama')->label('Nama :'),
                    TextEntry::make('nuptk')->label('NUPTK :'),
                    TextEntry::make('nik')->label('NIK :'),
                    TextEntry::make('tempat_lahir')->label('Tempat Lahir :'),
                    TextEntry::make('tanggal_lahir')->label('Tanggal Lahir :'),
                    TextEntry::make('bidang_studi_terakhir')->label('Bidang Studi Terakhir :'),
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
            'index' => Pages\Teacher::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            // 'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('web');
    }

    public static function getNavigationGroup(): ?string
    {
        return auth()->user()?->hasRole('web') ? 'Dapodik' : null;
    }
}
