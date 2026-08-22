<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Actions;

class LatestMessages extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Recent Inquiries & Contact Messages';

    public function table(Table $table): Table
    {
        return $table
            ->query(ContactMessage::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('email')->searchable()->wrap(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('subject')->wrap(),
                Tables\Columns\IconColumn::make('is_read')->label('Read')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ]);
    }
}
