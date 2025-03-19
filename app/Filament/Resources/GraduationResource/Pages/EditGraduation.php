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
            Actions\Action::make('download_pdf')
                ->label('Download SKL')
                ->url(fn () => route('download-certificate', ['id' => $this->record->student_id]))
                ->openUrlInNewTab(),
        ];
    }
}
