<?php

namespace App\Filament\Resources\SeizedVehicleResource\Pages;

use App\Filament\Resources\SeizedVehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeizedVehicle extends EditRecord
{
    protected static string $resource = SeizedVehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
