<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Models\Teacher as ModelsTeacher;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class Teacher extends ListRecords
{
    protected static string $resource = TeacherResource::class;
    protected function getHeaderActions(): array
    {
        $teacher = new ModelsTeacher();
        return [
            Action::make('sync')
                ->label('Syncron Dapodik')
                ->action(fn() => $teacher->sync())
                ->color('success'),

        ];
    }
}
