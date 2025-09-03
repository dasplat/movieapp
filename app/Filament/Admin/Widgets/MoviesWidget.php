<?php

namespace App\Filament\Admin\Widgets;

use Filament\Actions\Action;
use App\Models\Catalogue;
use App\Models\Movie;
use App\Models\SearchMovie;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class MoviesWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        $filter = $this->pageFilters['name'] ?? null;

        SearchMovie::setVar($filter);

        return SearchMovie::query();
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('AddToList')
                ->schema([
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
                ImageColumn::make('poster_path')
                    ->label('Poster')
                    ->imageWidth(100)
                    ->imageHeight(150)
                    ->extraImgAttributes([
                        'style' => 'border-radius: 10px;',
                    ]),

                TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->weight('medium')
                    ->alignLeft()
                    ->color('primary')
                    ->extraAttributes([
                        'class' => 'text-lg font-bold',
                    ]),

                BadgeColumn::make('release_date')
                    ->date('d/m/Y')
                    ->label('Release Date')
                    ->sortable()
                    ->colors([
                        'primary' => static fn($state): bool => $state !== null,
                    ])
                    ->extraAttributes([
                        'class' => 'text-sm',
                    ]),
                TextColumn::make('overview')
                    ->label('Overview')
                    ->sortable()
                    ->color('secondary')
                    ->wrap()
                    ->extraAttributes([
                        'class' => 'italic text-sm',
                    ]),

                BadgeColumn::make('vote_average')
                    ->numeric(decimalPlaces: 1)
                    ->label('Rating')
                    ->visible(static fn($state): bool => !$state == 0)
                    ->colors([
                        'danger' => static fn($state): bool => $state <= 3,
                        'warning' => static fn($state): bool => $state > 3 && $state <= 4.5,
                        'success' => static fn($state): bool => $state > 4.5,
                    ])
                    ->sortable()
                    ->extraAttributes([
                        'class' => 'font-medium',
                    ]),
            ])
        ];
    }
}
