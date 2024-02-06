<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

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

        ];
    }
}
