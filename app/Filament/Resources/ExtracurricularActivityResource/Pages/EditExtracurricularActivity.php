<?php

namespace App\Filament\Resources\ExtracurricularActivityResource\Pages;

use App\Filament\Resources\ExtracurricularActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExtracurricularActivity extends EditRecord
{
    protected static string $resource = ExtracurricularActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
