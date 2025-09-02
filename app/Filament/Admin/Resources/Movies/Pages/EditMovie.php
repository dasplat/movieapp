<?php

namespace App\Filament\Admin\Resources\Movies\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Admin\Resources\Movies\MovieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMovie extends EditRecord
{
    protected static string $resource = MovieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
