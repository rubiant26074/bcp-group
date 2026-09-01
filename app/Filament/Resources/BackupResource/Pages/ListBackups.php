<?php

namespace App\Filament\Resources\BackupResource\Pages;

use App\Filament\Resources\BackupResource;
use App\Models\Backup;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Artisan;

class ListBackups extends ListRecords
{
    protected static string $resource = BackupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createBackup')
                ->label('Create Database Backup')
                ->icon('heroicon-o-circle-stack')
                ->color('success')
                ->action(function () {
                    $dbPath = database_path('database.sqlite');
                    if (!file_exists($dbPath)) {
                        Notification::make()
                            ->title('Database file not found!')
                            ->danger()
                            ->send();
                        return;
                    }

                    $filename = 'bcp_backup_' . date('Y_m_d_His') . '.sqlite';
                    $backupDir = storage_path('app/backups');
                    
                    if (!file_exists($backupDir)) {
                        mkdir($backupDir, 0755, true);
                    }

                    $targetPath = $backupDir . '/' . $filename;
                    
                    // Copy SQLite database
                    if (copy($dbPath, $targetPath)) {
                        Backup::create([
                            'filename' => $filename,
                            'disk' => 'local',
                            'path' => 'backups/' . $filename,
                            'size_bytes' => filesize($targetPath),
                        ]);

                        Notification::make()
                            ->title('Backup Created Successfully!')
                            ->body("Backup file {$filename} saved.")
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Failed to Create Backup!')
                            ->danger()
                            ->send();
                    }
                }),

            Action::make('uploadBackup')
                ->label('Upload & Import Backup')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('warning')
                ->form([
                    FileUpload::make('backup_file')
                        ->label('Select .sqlite or .sql file from your PC')
                        ->disk('local')
                        ->directory('backups')
                        ->required()
                        ->storeFiles(true),
                ])
                ->action(function (array $data) {
                    $uploadedPath = storage_path('app/' . $data['backup_file']);
                    if (file_exists($uploadedPath)) {
                        $filename = basename($uploadedPath);
                        Backup::create([
                            'filename' => $filename,
                            'disk' => 'local',
                            'path' => $data['backup_file'],
                            'size_bytes' => filesize($uploadedPath),
                        ]);

                        Notification::make()
                            ->title('Backup Uploaded Successfully!')
                            ->body('You can now click Restore on the uploaded backup.')
                            ->success()
                            ->send();
                    }
                }),
        ];
    }
}
