<?php

namespace App\Filament\Resources\ClassRoomResource\Pages;

use App\Filament\Resources\ClassRoomResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassRoom extends EditRecord
{
    protected static string $resource = ClassRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali')
                ->icon('heroicon-o-arrow-left')
                ->color('success')
                ->url(fn() => route('filament.admin.resources.class-rooms.index')), // Sesuaikan dengan rute yang benar
        ];
    }
    protected function getFormActions(): array
    {
        return []; // Mengembalikan array kosong akan menghilangkan tombol Save
    }
}
