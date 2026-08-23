<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestProducts extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Product Catalog Overview';

    public function table(Table $table): Table
    {
        return $table
            ->query(Product::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\ImageColumn::make('image')->disk('public'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('category.name')->sortable()->wrap(),
                Tables\Columns\TextColumn::make('slug')->wrap(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ]);
    }
}
