<?php

namespace App\Filament\Admin\Resources\SearchBTCPriceResource\Pages;

use App\Filament\Admin\Resources\SearchBTCPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSearchBTCPrices extends ListRecords
{
    protected static string $resource = SearchBTCPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
