<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slider;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;
use UnitEnum;
use BackedEnum;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static string|UnitEnum|null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Hero Sliders';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subtitle')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->label('Slider Background Image')
                    ->image()
                    ->disk('public')
                    ->directory('sliders')
                    ->visibility('public')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('button_text')
                    ->label('Button Text (e.g. Explore Our Products)'),
                Forms\Components\TextInput::make('button_url')
                    ->label('Button Target URL (e.g. /produk)'),
                Forms\Components\TextInput::make('height')
                    ->label('Slider Height (in pixels)')
                    ->numeric()
                    ->default(500)
                    ->suffix('px')
                    ->helperText('Setting height applies globally to the Hero Slider container'),
                Forms\Components\TextInput::make('overlay_opacity')
                    ->label('Background Darkness / Overlay Opacity (%)')
                    ->numeric()
                    ->default(40)
                    ->suffix('%')
                    ->minValue(0)
                    ->maxValue(100)
                    ->helperText('0% = full original brightness, 100% = full dark'),
                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->disk('public'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()->wrap(),
                Tables\Columns\TextColumn::make('subtitle')->limit(40)->wrap(),
                Tables\Columns\TextColumn::make('height')->suffix('px'),
                Tables\Columns\TextColumn::make('overlay_opacity')->label('Darkness')->suffix('%'),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->filters([])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
