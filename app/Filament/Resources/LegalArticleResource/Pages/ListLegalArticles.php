<?php

namespace App\Filament\Resources\LegalArticleResource\Pages;

use App\Filament\Resources\LegalArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLegalArticles extends ListRecords
{
    protected static string $resource = LegalArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
