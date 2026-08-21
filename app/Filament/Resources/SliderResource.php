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

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static string|UnitEnum|null $navigationGroup = 'Content Management';

    protected static ?string $navigationLabel = 'Hero Sliders';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('e.g. PT BERKAH CIPTA PERSADA'),
                Forms\Components\Textarea::make('subtitle')
                    ->rows(2)
                    ->placeholder('Slide description or tagline text'),
                Forms\Components\TextInput::make('button_text')
                    ->placeholder('e.g. Explore Our Products'),
                Forms\Components\TextInput::make('button_url')
                    ->placeholder('e.g. /produk, /contact'),
                Forms\Components\FileUpload::make('image')
                    ->label('Slide Background Image')
                    ->image()
                    ->disk('public')
                    ->directory('sliders')
                    ->visibility('public')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('height')
                    ->label('Ketinggian Slider (px)')
                    ->numeric()
                    ->suffix('px')
                    ->default(500)
                    ->placeholder('500')
                    ->helperText('Ukuran tinggi slider dalam piksel (contoh: 450, 500, atau 600)'),
                Forms\Components\TextInput::make('overlay_opacity')
                    ->label('Kegelapan Overlay / Transparansi Filter (%)')
                    ->numeric()
                    ->suffix('%')
                    ->default(40)
                    ->placeholder('40')
                    ->helperText('0% = Gambar asli terang tanpa filter gelap, 100% = Sangat gelap. Disarankan 20-50%'),
                Forms\Components\TextInput::make('order')
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
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('height')->suffix(' px')->label('Height'),
                Tables\Columns\TextColumn::make('overlay_opacity')->suffix('%')->label('Dark Overlay'),
                Tables\Columns\TextColumn::make('order')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->defaultSort('order')
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
