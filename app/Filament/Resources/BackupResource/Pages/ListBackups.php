<?php

namespace App\Filament\Resources\BackupResource\Pages;

use App\Filament\Resources\BackupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBackups extends ListRecords
{
    protected static string $resource = BackupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('backup_database')
            ->label('Backup Solo Base de Datos')
            ->icon('heroicon-o-server')
            ->action(fn () => BackupResource::createBackup('database')),

            Actions\Action::make('backup_full')
                ->label('Backup Completo')
                ->icon('heroicon-o-archive-box')
                ->action(fn () => BackupResource::createBackup('full')),
        ];
    }
}
