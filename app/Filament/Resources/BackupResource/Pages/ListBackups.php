<?php

namespace App\Filament\Resources\BackupResource\Pages;

use App\Filament\Resources\BackupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions\Action;
use Artisan;
use Illuminate\Support\Facades\Artisan as FacadesArtisan;

class ListBackups extends ListRecords
{
    protected static string $resource = BackupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('backup_database')
            ->label('Backup Solo Base de Datos')
            ->icon('heroicon-o-server')
            ->action(fn () => BackupResource::createBackup('database')),

            Action::make('backup_full')
                ->label('Backup Completo')
                ->icon('heroicon-o-archive-box')
                ->action(fn () => BackupResource::createBackup('full')),
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\Action::make('backup')
                ->label('Create Backup')
                ->icon('heroicon-o-cloud-upload')
                ->action(function () {
                    // Ejecutar el comando para crear el backup
                    \Artisan::call('backup:run --only-db --disable-notifications');

                    // Notificación de éxito después de ejecutar el comando
                    session()->flash('success', 'Backup realizado exitosamente');
                }),
        ];
    }
}
