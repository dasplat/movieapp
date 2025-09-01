<?php

namespace App\Filament\Admin\Resources\SearchBTCPriceResource\Pages;

use App\Filament\Admin\Resources\SearchBTCPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSearchBTCPrice extends EditRecord
{
    protected static string $resource = SearchBTCPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
