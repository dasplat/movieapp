<?php

namespace App\Filament\Admin\Resources\Types\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Admin\Resources\Types\TypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTypes extends ManageRecords
{
    protected static string $resource = TypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
