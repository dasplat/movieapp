<?php

namespace App\Filament\Admin\Resources\Catalogues;

use Filament\Schemas\Schema;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Admin\Resources\Catalogues\Pages\ManageCatalogues;
use App\Models\Catalogue;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Actions;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CatalogueResource extends Resource
{
    protected static ?string $model = Catalogue::class;

    public static ?string $label = 'list';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-list-bullet';

    protected static string | \UnitEnum | null $navigationGroup = "Lists management";

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description')
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->hiddenLabel(),
                TextEntry::make('description')
                    ->hiddenLabel(),
                RepeatableEntry::make('movies')
                    ->schema([
                        ImageEntry::make('poster_path')
                            ->imageHeight(100)
                            ->hiddenLabel(),
                        TextEntry::make('title')
                            ->hiddenLabel()
                            ->extraAttributes([
                                'style' => 'margin-top: 15%;'
                            ]),
                        Actions::make([
                            Action::make('watched')
                                ->hiddenLabel()
                                ->url('https://youtu.be/dQw4w9WgXcQ?si=gTmeIDLACuXX6Ktq')
                                ->icon(Heroicon::Eye),
                            Action::make('delete')
                                ->url('https://www.youtube.com/watch?v=L1WAOByxzYA')
                                ->hiddenLabel()
                                ->color('danger')
                                ->requiresConfirmation()
                                ->icon(Heroicon::Trash),
                        ])->extraAttributes([
                            'style' => 'margin-top: 12%; margin-left:50%'
                        ])
                    ])
                    ->columnSpanFull()
                    ->columns([
                        'default' => 3,
                    ])
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCatalogues::route('/'),
        ];
    }
}
