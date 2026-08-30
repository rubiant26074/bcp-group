<?php

namespace App\Filament\Resources\Media\Tables;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use App\Models\Media;

class MediaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('file_path')
                    ->label('Preview')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(null),

                TextColumn::make('file_name')
                    ->label('File Name')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('url')
                    ->label('Copy URL')
                    ->getStateUsing(fn (Media $record) => asset('storage/' . $record->file_path))
                    ->copyable()
                    ->copyMessage('URL copied!')
                    ->icon('heroicon-o-clipboard')
                    ->color('success'),

                TextColumn::make('file_type')
                    ->label('Mime Type')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('file_size')
                    ->label('Size')
                    ->formatStateUsing(fn ($state) => number_format($state / 1024, 2) . ' KB')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
