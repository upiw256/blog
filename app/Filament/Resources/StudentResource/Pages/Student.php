<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Student as StudentModel;
use Intervention\Image\ImageManager;
use Intervention\Image\Decoders\FilePathImageDecoder;
use Intervention\Image\Drivers\Imagick\Driver;
// use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Encoders\GifEncoder;

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
            $filePath = 'qrcodes/' . $student->peserta_didik_id . '.png';
            if (!Storage::exists($filePath)) {
                $qrCode = QrCode::format('png')
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
        // Menyusun data untuk QR code
        $studentData = 'Nama: ' . $record->nama . "\n" .
                       'Jenis Kelamin: ' . $record->jenis_kelamin . "\n" .
                       'Tempat Lahir: ' . $record->tempat_lahir . "\n" .
                       'Tanggal Lahir: ' . $record->tanggal_lahir . "\n" .
                       'Alamat: ' . $record->alamat_jalan . "\n" .
                       'Nama Ibu: ' . $record->nama_ibu;
    
        // Path file QR code (misalnya PNG atau SVG)
        $filePath = storage_path('app/qrcodes/' . $record->peserta_didik_id . '.png');  // Sesuaikan dengan lokasi dan nama file QR Code Anda
        $cardPath = storage_path('app/card/' . $record->peserta_didik_id . '.png');  // Sesuaikan dengan lokasi dan nama file QR Code Anda
    
        // Membuat ImageManager instance dengan Imagick driver
        $manager = new ImageManager(Driver::class);
    
        // Membuat gambar baru 640x480 dengan background putih
        $img = $manager->create(640, 480)->fill('#ffffff');
    
        // Menambahkan teks ke gambar dengan font
        $img->text('Nama: ' . $record->nama, 20, 20, function($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(24);
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
        });
        $img->text('Jenis Kelamin: ' . $record->jenis_kelamin, 20, 60, function($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(24);
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
        });
        $img->text('Tempat Lahir: ' . $record->tempat_lahir, 20, 100, function($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(24);
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
        });
        $img->text('Tanggal Lahir: ' . $record->tanggal_lahir, 20, 140, function($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(24);
            $font->color('#000000');
            $font->align('left');
            $font->valign('top');
        });
    
        // Membaca gambar QR code menggunakan read() dan menambahkannya ke gambar utama
        $qrCodeImage = $manager->read(Storage::get('qrcodes/' . $record->peserta_didik_id . '.png'));  // Membaca file gambar QR Code
    
        // Menambahkan QR code ke gambar utama dengan penyesuaian posisi dan transparansi
        $img->place($qrCodeImage, 'bottom-right', 20, 20);  // Menambahkan QR code di sudut kanan bawah
    
        // Mengembalikan gambar sebagai file PNG
        // Ensure the directory exists
        if (!Storage::exists('card')) {
            Storage::makeDirectory('card');
        }
        $img->save($cardPath); // Save the image as a PNG file

        // Return the image as a response
        return response()->file($cardPath, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'inline; filename="' . basename($cardPath) . '"'
        ]);
    }

}
