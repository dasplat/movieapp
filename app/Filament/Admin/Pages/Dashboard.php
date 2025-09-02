<?php

namespace App\Filament\Admin\Pages;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use App\Filament\Admin\Widgets\MoviesWidget;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        return $schema->components([
            Section::make([
                TextInput::make('name')
                    ->columnSpanFull()
                    ->debounce(500)
                    ->reactive()
            ])->columnSpanFull()
        ]);
    }

    public function getWidgets(): array
    {
        return [
            MoviesWidget::class,
        ];
    }
}
