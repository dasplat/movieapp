<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\MoviesWidget;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form->schema([
            Section::make([
                TextInput::make('name')
                    ->columnSpanFull()
                    ->debounce(500)
                    ->reactive()
            ])
        ]);
    }

    public function getWidgets(): array
    {
        return [
            MoviesWidget::class,
        ];
    }
}
