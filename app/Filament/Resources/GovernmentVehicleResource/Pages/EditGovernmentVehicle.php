<?php

namespace App\Filament\Resources\GovernmentVehicleResource\Pages;

use App\Filament\Resources\GovernmentVehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGovernmentVehicle extends EditRecord
{
    protected static string $resource = GovernmentVehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
