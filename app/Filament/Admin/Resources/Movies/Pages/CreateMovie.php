<?php

namespace App\Filament\Admin\Resources\Movies\Pages;

use App\Filament\Admin\Resources\Movies\MovieResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMovie extends CreateRecord
{
    protected static string $resource = MovieResource::class;
}
