<?php

namespace App\Filament\Resources\Media\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('file_path')
                    ->label('Upload File')
                    ->required()
                    ->disk('public')
                    ->directory('media')
                    ->visibility('public')
                    ->columnSpanFull()
                    ->acceptedFileTypes([
                        'image/*',
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/zip',
                        'application/x-zip-compressed',
                        'text/plain',
                    ])
                    ->saveUploadedFileUsing(function ($file, $get, $set) {
                        $filename = $file->getClientOriginalName();
                        $mimeType = $file->getMimeType();
                        $fileSize = $file->getSize();

                        // Store under media directory
                        $storedPath = $file->storeAs('media', $filename, 'public');

                        $set('file_name', $filename);
                        $set('file_type', $mimeType);
                        $set('file_size', $fileSize);

                        return $storedPath;
                    }),

                Hidden::make('file_name'),
                Hidden::make('file_type'),
                Hidden::make('file_size'),
            ]);
    }
}
