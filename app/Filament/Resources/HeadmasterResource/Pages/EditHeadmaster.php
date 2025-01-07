<?php

namespace App\Filament\Resources\HeadmasterResource\Pages;

use App\Filament\Resources\HeadmasterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHeadmaster extends EditRecord
{
    protected static string $resource = HeadmasterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
