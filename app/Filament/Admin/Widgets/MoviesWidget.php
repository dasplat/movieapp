<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Catalogue;
use App\Models\Movie;
use App\Models\SearchBTCPrice;
use App\Models\SearchMovie;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;
use Filament\Tables\Actions\Action;

class MoviesWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        $filter = $this->filters['name'] ?? null;

        SearchMovie::setVar($filter);

       return SearchMovie::query();
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('AddToList')
                ->form([
                    Select::make('catalogue_id')
                        ->label('List')
                        ->options(Catalogue::query()->pluck('name', 'id'))
                        ->required(),
                ])
                ->action(function (array $data, SearchMovie $record): void {
                    $movie = new Movie();
                    $movie->title = $record->title;
                    $movie->overview = $record->overview;
                    $movie->poster_path = $record->poster_path;
                    $movie->release_date = $record->release_date;
                    $movie->vote_average = $record->vote_average;
                    $movie->catalogue_id = $data['catalogue_id'];
                    $movie->save();
                })
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            Stack::make([
                // Poster Image
                ImageColumn::make('poster_path')
                    ->label('Poster')
                    ->extraImgAttributes([
                        'src' => 'img',
                        'width' => '100%', // Make the image responsive
                        'style' => 'border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);', // Add rounded corners and shadow
                    ]),

                // Title
                TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->weight('medium')
                    ->alignLeft()
                    ->color('primary') // Apply a primary color
                    ->extraAttributes([
                        'class' => 'text-lg font-bold', // Increase font size and bold
                    ]),

                // Release Date
                BadgeColumn::make('release_date')
                    ->label('Release Date')
                    ->sortable()
                    ->colors([
                        'primary' => static fn ($state): bool => $state !== null,
                    ])
                    ->extraAttributes([
                        'class' => 'text-sm', // Smaller text for badges
                    ]),

                // Overview
                TextColumn::make('overview')
                    ->label('Overview')
                    ->sortable()
                    ->color('secondary')
                    ->wrap() // Wrap long text
                    ->extraAttributes([
                        'class' => 'italic text-sm', // Add italic style and smaller font
                    ]),

                // Rating
                BadgeColumn::make('vote_average')
                    ->label('Rating')
                    ->colors([
                        'danger' => static fn ($state): bool => $state <= 3,
                        'warning' => static fn ($state): bool => $state > 3 && $state <= 4.5,
                        'success' => static fn ($state): bool => $state > 4.5,
                    ])
                    ->sortable()
                    ->extraAttributes([
                        'class' => 'font-medium', // Medium font weight for badges
                    ]),
            ])
        ];
    }
}
