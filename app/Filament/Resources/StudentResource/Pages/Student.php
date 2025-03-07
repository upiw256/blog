<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Student as StudentModel;
use Intervention\Image\ImageManagerStatic as Image;

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

    public function downloadStudentData(StudentModel $record)
    {
        $studentData = 'Nama: ' . $record->nama . "\n" .
                       'Jenis Kelamin: ' . $record->jenis_kelamin . "\n" .
                       'Tempat Lahir: ' . $record->tempat_lahir . "\n" .
                       'Tanggal Lahir: ' . $record->tanggal_lahir . "\n" .
                       'Alamat: ' . $record->alamat_jalan . "\n" .
                       'Nama Ibu: ' . $record->nama_ibu;

        // Generate QR code
        $qrCode = QrCode::format('png')->size(200)->generate($studentData);

        // Create a new image
        $img = Image::canvas(400, 300, '#ffffff');

        // Add text to the image
        $img->text('Nama: ' . $record->nama, 20, 20, function($font) {
            $font->size(24);
            $font->color('#000000');
        });
        $img->text('Jenis Kelamin: ' . $record->jenis_kelamin, 20, 60, function($font) {
            $font->size(24);
            $font->color('#000000');
        });
        $img->text('Tempat Lahir: ' . $record->tempat_lahir, 20, 100, function($font) {
            $font->size(24);
            $font->color('#000000');
        });
        $img->text('Tanggal Lahir: ' . $record->tanggal_lahir, 20, 140, function($font) {
            $font->size(24);
            $font->color('#000000');
        });
        $img->text('Alamat: ' . $record->alamat_jalan, 20, 180, function($font) {
            $font->size(24);
            $font->color('#000000');
        });
        $img->text('Nama Ibu: ' . $record->nama_ibu, 20, 220, function($font) {
            $font->size(24);
            $font->color('#000000');
        });

        // Add QR code to the image
        $img->insert($qrCode, 'bottom-right', 20, 20);

        // Return the image as a PNG file
        return $img->response('png')->header('Content-Disposition', 'attachment; filename="student_data.png"');
    }
}
