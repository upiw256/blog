<?php

namespace App\Filament\Resources\GraduationResource\Pages;

use App\Filament\Resources\GraduationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGraduation extends EditRecord
{
    protected static string $resource = GraduationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
