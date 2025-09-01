<?php

namespace App\Filament\Admin\Resources\CatalogueResource\Pages;

use App\Filament\Admin\Resources\CatalogueResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCatalogues extends ManageRecords
{
    protected static string $resource = CatalogueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
