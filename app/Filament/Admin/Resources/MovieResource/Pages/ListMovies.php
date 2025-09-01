<?php

namespace App\Filament\Admin\Resources\MovieResource\Pages;

use App\Filament\Admin\Resources\MovieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMovies extends ListRecords
{
    protected static string $resource = MovieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
