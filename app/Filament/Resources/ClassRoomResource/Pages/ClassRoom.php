<?php

namespace App\Filament\Resources\ClassRoomResource\Pages;

use App\Filament\Resources\ClassRoomResource;
use App\Models\ClassRoom as ModelsClassRoom;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

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

        ];
    }
}
