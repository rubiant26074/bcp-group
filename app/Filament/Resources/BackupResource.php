<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BackupResource\Pages;
use App\Models\Backup;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use BackedEnum;
use UnitEnum;

class BackupResource extends Resource
{
    protected static ?string $model = Backup::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-circle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Backup & Restore Database';

    protected static ?string $modelLabel = 'Database Backup';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('filename')
                    ->label('Backup File Name')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('size_bytes')
                    ->label('File Size')
                    ->formatStateUsing(fn ($state) => number_format($state / 1024, 2) . ' KB')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created Date')
                    ->dateTime('d M Y H:i:s')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->action(function (Backup $record) {
                        $filePath = storage_path('app/' . $record->path);
                        if (file_exists($filePath)) {
                            return response()->download($filePath, $record->filename);
                        }

                        Notification::make()
                            ->title('Backup File Not Found!')
                            ->danger()
                            ->send();
                    }),

                Actions\Action::make('restore')
                    ->label('Restore Database')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Restore Database Snapshot?')
                    ->modalDescription('WARNING: Restoring this backup will replace your current database with the selected backup snapshot. Are you sure you want to proceed?')
                    ->action(function (Backup $record) {
                        $backupPath = storage_path('app/' . $record->path);
                        $dbPath = database_path('database.sqlite');

                        if (!file_exists($backupPath)) {
                            Notification::make()
                                ->title('Backup File Missing!')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Create safety temp backup of current state
                        @copy($dbPath, storage_path('app/backups/safety_before_restore.sqlite'));

                        // Restore DB
                        if (copy($backupPath, $dbPath)) {
                            \Illuminate\Support\Facades\Artisan::call('config:clear');
                            \Illuminate\Support\Facades\Artisan::call('cache:clear');

                            Notification::make()
                                ->title('Database Restored Successfully!')
                                ->body("Restored from {$record->filename}.")
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Failed to Restore Database!')
                                ->danger()
                                ->send();
                        }
                    }),

                Actions\DeleteAction::make()
                    ->before(function (Backup $record) {
                        $filePath = storage_path('app/' . $record->path);
                        if (file_exists($filePath)) {
                            @unlink($filePath);
                        }
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBackups::route('/'),
        ];
    }
}
