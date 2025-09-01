<?php

namespace App\Filament\Admin\Resources\MovieResource\Pages;

use App\Filament\Admin\Resources\MovieResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMovie extends CreateRecord
{
    protected static string $resource = MovieResource::class;
}
