<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MovieResource\Pages;
use App\Filament\Admin\Resources\MovieResource\RelationManagers;
use App\Models\Movie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $navigationGroup = "Lists management";

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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                            'primary' => static fn($state): bool => $state !== null,
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
                            'danger' => static fn($state): bool => $state <= 3,
                            'warning' => static fn($state): bool => $state > 3 && $state <= 4.5,
                            'success' => static fn($state): bool => $state > 4.5,
                        ])
                        ->sortable()
                        ->extraAttributes([
                            'class' => 'font-medium', // Medium font weight for badges
                        ]),
                ])
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }
}
