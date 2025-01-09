<?php

namespace App\Filament\Resources\ClassRoomResource\RelationManagers;

use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use App\Models\Schedule;
use Closure;
use Filament\Forms\Components\Component;
use Filament\Forms\Get;
class ScheduleRelationManager extends RelationManager
{
    protected static string $relationship = 'schedules'; // Ubah ke huruf kecil
    protected function isScheduleConflict($day, $startTime)
    {
        return Schedule::where('day_of_week', $day)
            ->where('start_time', $startTime)
            ->exists(); // Cek apakah ada jadwal dengan start_time yang sama pada hari tersebut
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Tabs::make('jadwal_hari')
                    ->tabs([
                        Tab::make('Senin')
                            ->schema([
                                Forms\Components\Radio::make('day_of_week')
                                    ->label('Pilih Hari')
                                    ->options([
                                        'monday' => 'Senin',
                                    ])
                                    ->default('monday')
                                    ->required(),
                                Forms\Components\TimePicker::make('start_time')
                                    ->label('Jam Mulai')
                                    ->seconds(false)
                                    ->format('H:i')
                                    ->required(),
                                Forms\Components\TimePicker::make('end_time')
                                    ->label('Jam Selesai')
                                    ->seconds(false)
                                    ->format('H:i')
                                    ->required(),
                            ]),
                        Tab::make('Selasa')
                            ->schema([
                                Forms\Components\Radio::make('day_of_week')
                                    ->label('Pilih Hari')
                                    ->options([
                                        'tuesday' => 'Selasa',
                                    ])
                                    ->default('tuesday')
                                    ->required(),
                                Forms\Components\TimePicker::make('start_time')
                                    ->label('Jam Mulai')
                                    ->seconds(false)
                                    ->format('H:i')
                                    ->required(),
                                Forms\Components\TimePicker::make('end_time')
                                    ->label('Jam Selesai')
                                    ->seconds(false)
                                    ->format('H:i')
                                    ->required(),
                            ]),
                        Tab::make('Rabu')
                            ->schema([
                                Forms\Components\Radio::make('day_of_week')
                                    ->label('Pilih Hari')
                                    ->options([
                                        'wednesday' => 'Rabu',
                                    ])
                                    ->default('wednesday')
                                    ->required(),
                                Forms\Components\TimePicker::make('start_time')
                                    ->label('Jam Mulai')
                                    ->seconds(false)
                                    ->format('H:i')
                                    ->required(),
                                Forms\Components\TimePicker::make('end_time')
                                    ->label('Jam Selesai')
                                    ->seconds(false)
                                    ->format('H:i')
                                    ->required(),
                            ]),
                        Tab::make('Kamis')
                            ->schema([
                                Forms\Components\Radio::make('day_of_week')
                                    ->label('Pilih Hari')
                                    ->options([
                                        'thursday' => 'Kamis',
                                    ])
                                    ->default('thursday')
                                    ->required(),
                                Forms\Components\TimePicker::make('start_time')
                                    ->label('Jam Mulai')
                                    ->seconds(false)
                                    ->format('H:i')
                                    ->required(),
                                Forms\Components\TimePicker::make('end_time')
                                    ->label('Jam Selesai')
                                    ->seconds(false)
                                    ->format('H:i')
                                    ->required(),
                            ]),
                        Tab::make('Jumat')
                            ->schema([
                                Forms\Components\Radio::make('day_of_week')
                                    ->label('Pilih Hari')
                                    ->options([
                                        'friday' => 'Jumat',
                                    ])
                                    ->default('friday')
                                    ->required(),
                                Forms\Components\TimePicker::make('start_time')
                                    ->label('Jam Mulai')
                                    ->seconds(false)
                                    ->format('H:i')
                                    ->required(),
                                Forms\Components\TimePicker::make('end_time')
                                    ->label('Jam Selesai')
                                    ->seconds(false)
                                    ->format('H:i')
                                    ->required(),
                            ]),
                    ]),
                Forms\Components\Select::make('teacher_subject_id')
                    ->label('Mata Pelajaran dan Guru')
                    ->relationship(
                        name: 'teacherSubject',
                        titleAttribute: 'subject_name',
                        modifyQueryUsing: fn(Builder $query) =>
                        $query->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
                            ->join('teachers', 'teachers.id', '=', 'teacher_subjects.teacher_id')
                            ->select('teacher_subjects.id', 'subjects.name as subject_name', 'teachers.nama as teacher_name')
                            ->orderBy('teacher_subjects.id', 'asc')
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn($record) => "{$record->teacher_name} - {$record->subject_name}"
                    )
                    ->searchable(['subjects.name', 'teachers.nama'])
                    ->required(),
            ]);

    }



    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('schedule_id')
            ->columns([
                Tables\Columns\TextColumn::make('teacherSubject.teacher.nama')
                    ->label('Guru')
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        // Combine teacher's name and subject
                        return $record->teacherSubject->teacher->nama . ' - ' . $record->teacherSubject->subject->name;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Hari')
                    ->sortable()
                    ->formatStateUsing(fn(string $state) => match (strtolower($state)) {
                        'monday' => 'Senin',
                        'tuesday' => 'Selasa',
                        'wednesday' => 'Rabu',
                        'thursday' => 'Kamis',
                        'friday' => 'Jumat',
                        default => ucfirst($state),
                    }),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Jam Masuk')
                    ->dateTime('H:i'), // Format waktu lebih spesifik
                Tables\Columns\TextColumn::make('end_time')
                    ->label('Jam Keluar')
                    ->dateTime('H:i'),
            ])
            ->filters([
                Tables\Filters\Filter::make('Senin')
                    ->query(fn(Builder $query) => $query->where('day_of_week', 'monday')),
                Tables\Filters\Filter::make('Selasa')
                    ->query(fn(Builder $query) => $query->where('day_of_week', 'tuesday')),
                Tables\Filters\Filter::make('Rabu')
                    ->query(fn(Builder $query) => $query->where('day_of_week', 'wednesday')),
                Tables\Filters\Filter::make('Kamis')
                    ->query(fn(Builder $query) => $query->where('day_of_week', 'thursday')),
                Tables\Filters\Filter::make('Jumat')
                    ->query(fn(Builder $query) => $query->where('day_of_week', 'friday')),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
