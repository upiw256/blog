<?php

namespace App\Filament\Resources\SubjectResource\Pages;

use App\Filament\Resources\SubjectResource;
use Filament\Actions;
use Filament\Actions\Action;
use App\Models\Subject as ModelsSubject;
use Filament\Resources\Pages\ListRecords;

class ListSubjects extends ListRecords
{
    protected static string $resource = SubjectResource::class;

    protected function getHeaderActions(): array
    {
        $subject = new ModelsSubject();
        return [
            Actions\CreateAction::make(),
            Action::make('sync')
                ->label('Syncron Dapodik')
                ->action(fn() => $subject->sync())
                ->color('success'),
        ];
    }
}
