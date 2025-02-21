<?php

namespace App\Filament\Resources\SubjectResource\Pages;

use App\Filament\Resources\SubjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use App\Models\TeacherSubject;
class EditSubject extends EditRecord
{
    protected static string $resource = SubjectResource::class;

    protected function getHeaderActions(): array
    {
        
        return [
            Actions\Action::make('back')
                ->label('Kembali')
                ->icon('heroicon-o-arrow-left')
                ->color('success')
                ->url(fn() => route('filament.admin.resources.subjects.index')), // Sesuaikan dengan rute yang benar
                
        ];
    }
    protected function getFormActions(): array
    {
        return []; // Mengembalikan array kosong akan menghilangkan tombol Save
    }
}
