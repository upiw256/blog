<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Infolists\Components\Section;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Actions\Action;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Storage;

class StudentResource extends Resource
{
    public $studentId;
    public $student;

    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
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
                Tables\Columns\TextColumn::make('id')->label('No'),
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('nama_rombel')->label('Kelas'),
            ])
            ->filters([
                
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
                Section::make('Data Diri - Perubahan data lakukan di aplikasi dapodik')
                ->schema([
                    TextEntry::make('nama')->label('Nama :'),
                    TextEntry::make('jenis_kelamin')->label('Jenis Kelamin :'),
                    TextEntry::make('tempat_lahir')->label('Tempat Lahir :'),
                    TextEntry::make('tanggal_lahir')->label('Tanggal Lahir :'),
                    TextEntry::make('alamat_jalan')->label('Alamat Jalan :'),
                    TextEntry::make('nama_ibu')->label('Nama Ibu :'),
                    TextEntry::make('peserta_didik_id')
                    ->label('QR Code')
                    ->formatStateUsing(function ($record) {
                        $filePath = 'qrcodes/' . $record->peserta_didik_id . '.svg';
                        if (Storage::exists($filePath)) {
                            return '<img src="' . Storage::url($filePath) . '" alt="QR Code">';
                        }
                        return '<p style="font-size: 12px; color: red;">QR Code Tidak Tersedia</p>';
                    })
                    ->html(),
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
            'index' => Pages\Student::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'list' => Pages\ListStudents::route('/{record}/list'),
        ];
    }

}