<?php

namespace App\Filament\Resources\ExtracurricularActivityResource\Pages;

use App\Filament\Resources\ExtracurricularActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExtracurricularActivities extends ListRecords
{
    protected static string $resource = ExtracurricularActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
