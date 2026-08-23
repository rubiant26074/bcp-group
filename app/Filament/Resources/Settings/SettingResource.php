<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\Pages\ManageSettings;
use App\Models\Setting;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $recordTitleAttribute = 'label';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?string $modelLabel = 'Setting';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('label')
                    ->label('Setting Name')
                    ->disabled()
                    ->dehydrated(false),
                
                Toggle::make('value')
                    ->label('Status')
                    ->visible(fn ($record) => $record?->type === 'boolean')
                    ->dehydrateStateUsing(fn ($state) => $state ? 'true' : 'false')
                    ->afterStateHydrated(fn ($component, $state) => $component->state($state === 'true')),

                TextInput::make('value')
                    ->label('Value')
                    ->visible(fn ($record) => $record?->type === 'text'),

                Textarea::make('value')
                    ->label('Value')
                    ->visible(fn ($record) => $record?->type === 'textarea'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('label')
            ->columns([
                TextColumn::make('label')
                    ->label('Setting Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('value')
                    ->label('Current Value')
                    ->formatStateUsing(function ($state, Setting $record) {
                        if ($record->type === 'boolean') {
                            return $state === 'true' ? 'Active' : 'Inactive';
                        }
                        return $state;
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSettings::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
