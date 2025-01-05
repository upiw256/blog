<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;
    protected static ?string $navigationGroup = 'Jadwal';
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                forms\Components\Select::make('class_room_id')
                    ->relationship('classRoom', 'nama')
                    ->searchable()
                    ->required(),
                forms\Components\Select::make('day_of_week')
                    ->options([
                        'monday' => 'Senin',
                        'tuesday' => 'Selasa',
                        'wednesday' => 'Rabu',
                        'thursday' => 'Kamis',
                        'friday' => 'Jumat',
                    ])
                    ->required(),
                forms\Components\TimePicker::make('start_time')
                    ->withoutSeconds()
                    ->format('H:i')
                    ->required(),
                forms\Components\TimePicker::make('end_time')
                    ->withoutSeconds()
                    ->format('H:i')
                    ->required(),
                forms\Components\Select::make('teacher_subject_id')
                    ->label('Mata Pelajaran dan Guru')
                    ->relationship(
                        name: 'teacherSubject',
                        titleAttribute: 'subject_name',
                        modifyQueryUsing: fn(Builder $query) =>
                        // Lakukan join dan pilih data yang dibutuhkan
                        $query->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
                            ->join('teachers', 'teachers.id', '=', 'teacher_subjects.teacher_id')
                            ->select('teacher_subjects.id', 'subjects.name as subject_name', 'teachers.nama as teacher_name')
                            ->orderBy('teacher_subjects.id', 'asc')
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn($record) =>
                        // Gabungkan nama guru dan mata pelajaran
                        "{$record->teacher_name} - {$record->subject_name}"
                    )
                    ->searchable(['subjects.name', 'teachers.nama']) // Aktifkan pencarian untuk pilihan
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
