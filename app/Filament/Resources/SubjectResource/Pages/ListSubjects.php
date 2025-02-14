<?php

namespace App\Filament\Resources\SubjectResource\Pages;

use App\Filament\Resources\SubjectResource;
use Filament\Actions;
use Filament\Actions\Action;
use App\Models\Subject as ModelsSubject;
use App\Models\TeacherSubject;
use Filament\Resources\Pages\ListRecords;

class ListSubjects extends ListRecords
{
    protected static string $resource = SubjectResource::class;

    protected function getHeaderActions(): array
    {
        $subject = new ModelsSubject();
        $teacherSubject = new TeacherSubject();
        return [
            Actions\CreateAction::make(),
            Action::make('sync')
                ->label('Syncron Dapodik')
                ->action(fn() => $subject->sync())
                ->color('success'),
                Action::make('sync')
                ->label('Syncron Pengajar')
                ->action(fn() => $teacherSubject->sync())
                ->color('danger'),
        ];
    }
}
