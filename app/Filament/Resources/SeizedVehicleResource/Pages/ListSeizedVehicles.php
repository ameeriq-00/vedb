<?php

namespace App\Filament\Resources\SeizedVehicleResource\Pages;

use App\Filament\Resources\SeizedVehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSeizedVehicles extends ListRecords
{
    protected static string $resource = SeizedVehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
