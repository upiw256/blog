<?php

namespace App\Filament\Resources\ClassRoomResource\Pages;

use App\Filament\Resources\ClassRoomResource;
use App\Models\ClassRoom as ModelsClassRoom;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use App\Exports\ScheduleTemplateExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Schedule;
class ClassRoom extends ListRecords
{
    protected static string $resource = ClassRoomResource::class;
    protected function getHeaderActions(): array
    {
        $teacher = new ModelsClassRoom();
        return [
            Action::make('sync')
                ->label('Syncron Dapodik')
                ->action(fn() => $teacher->sync())
                ->color('success'),
            Action::make('downloadTemplate')
                ->label('Download Template')
                ->action(fn() => $this->downloadTemplate()),
            Action::make('deleteAllSchedule')
                ->label('Hapus semua jadwal')
                ->requiresConfirmation()
                ->action(fn() => Schedule::truncate())
                ->color('danger')
        ];
    }
    public function downloadTemplate()
    {
        return Excel::download(new ScheduleTemplateExport, 'schedule_template.xlsx');
    }
}
