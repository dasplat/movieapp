<?php

namespace App\Filament\Admin\Pages;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use App\Filament\Admin\Widgets\MoviesWidget;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;

    public static function getNavigationLabel(): string
    {
        return __('base.dashboard.dashboard');
    }

    public static function getNavigationIcon(): string|BackedEnum|Htmlable|null
    {
        return Heroicon::MagnifyingGlass;
    }

    protected static ?string $title = '';

    public function filtersForm(Schema $schema): Schema
    {
        return $schema->components([
            Section::make([
                TextInput::make('name')
                    ->label(__('base.dashboard.searchMovie'))
                    ->placeholder(__('base.dashboard.placeholders.searchMovie'))
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
