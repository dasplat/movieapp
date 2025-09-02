<?php

namespace App\Filament\Admin\Resources\Catalogues\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Admin\Resources\Catalogues\CatalogueResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCatalogues extends ManageRecords
{
    protected static string $resource = CatalogueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
