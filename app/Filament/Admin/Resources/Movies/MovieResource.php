<?php

namespace App\Filament\Admin\Resources\Movies;

use Filament\Schemas\Schema;
use App\Filament\Admin\Resources\Movies\Pages\ListMovies;
use App\Filament\Admin\Resources\Movies\Pages\CreateMovie;
use App\Filament\Admin\Resources\Movies\Pages\EditMovie;
use App\Models\Movie;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-video-camera';

    protected static string | \UnitEnum | null $navigationGroup = "Lists management";

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'publish'
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    ImageColumn::make('poster_path')
                        ->label('Poster')
                        ->imageWidth(100)
                        ->imageHeight(150)
                        ->extraImgAttributes([
                            'style' => 'border-radius: 10px;'
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
                        ->visible(static fn($state): bool => !$state == 0)
                        ->label('Rating')
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
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // Tables\Actions\EditAction::make(),
            ])
            ->toolbarActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMovies::route('/'),
            'create' => CreateMovie::route('/create'),
            'edit' => EditMovie::route('/{record}/edit'),
        ];
    }
}
