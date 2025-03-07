<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Student extends ListRecords
{
    protected static string $resource = StudentResource::class;
    protected function getHeaderActions(): array
    {
        $student = new \App\Models\Student();
        return [
            Action::make('sync')
                ->label('Syncron Dapodik')
                ->action(fn() => $student->sync())
                ->color('success'),
                Action::make('export')
                    ->label('Export Data with QR Code')
                    ->action(fn() => $this->exportDataWithQRCode())
                    ->color('primary'),

        ];
    }
    public function exportDataWithQRCode()
    {
        $students = \App\Models\Student::all();
        $students->each(function ($student) {
            $filePath = 'qrcodes/' . $student->peserta_didik_id . '.svg';
            if (!Storage::exists($filePath)) {
                $qrCode = QrCode::format('svg')
                ->size(200)
                ->margin(2)
                ->generate((string)$student->peserta_didik_id);
                Storage::put($filePath, $qrCode);
            }
        });
        session()->flash('message', 'QR Code images generated and saved successfully');
    }
}
