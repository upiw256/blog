<?php

namespace App\Filament\Resources\GraduationResource\Pages;

use App\Filament\Resources\GraduationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Student;
use App\Models\Graduation;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GraduationsExport;

class ListGraduations extends ListRecords
{
    protected static string $resource = GraduationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('sync')
                ->label('Synchronize')
                ->action('syncGraduations'),
            Actions\Action::make('delete')
                ->label('Hapus data')
                ->action('truncateGraduationsTable')
                ->color('danger'),
            Actions\Action::make('download_excel')
                ->label('Download Excel')
                ->action('downloadExcel'),
        ];
    }

    public function syncGraduations()
    {
        $students = Student::where('nama_rombel', 'like', '%XII%')->get();

        foreach ($students as $student) {
            Graduation::updateOrCreate(
                ['student_id' => $student->id],
                ['information' => true] // Default value, can be adjusted
            );
        }

        Notification::make()
            ->title('Success')
            ->body('Graduations synchronized successfully.')
            ->success()
            ->send();
    }

    public function truncateGraduationsTable()
    {
        Graduation::truncate();

        Notification::make()
            ->title('Success')
            ->body('Graduations table truncated successfully.')
            ->success()
            ->send();
    }

    public function downloadExcel()
    {
        return Excel::download(new GraduationsExport, 'graduations.xlsx');
    }
}
