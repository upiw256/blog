<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User as ModelsUser;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class User extends ListRecords
{
    protected static string $resource = UserResource::class;
    protected function getHeaderActions(): array
    {
        $user = new ModelsUser();
        return [
            Action::make('sync')
                ->label('Syncron Dapodik')
                ->action(fn() => $user->sync())
                ->color('success'),
            Actions\CreateAction::make(),

        ];
    }
}
