<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CatalogueResource\Pages;
use App\Filament\Admin\Resources\CatalogueResource\RelationManagers;
use App\Models\Catalogue;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CatalogueResource extends Resource
{
    protected static ?string $model = Catalogue::class;

    public static ?string $label = 'list';

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationGroup = "Lists management";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name')
                    ->hiddenLabel(),
                TextEntry::make('description')
                    ->hiddenLabel(),
                RepeatableEntry::make('movies')
                    ->schema([
                        ImageEntry::make('poster_path')
                            ->hiddenLabel(),
                        TextEntry::make('title')
                            ->hiddenLabel(),
                        TextEntry::make('overview')
                            ->hiddenLabel(),
                    ])
                    ->columns(1)
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCatalogues::route('/'),
        ];
    }
}
