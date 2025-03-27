<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BackupResource\Pages;
use App\Models\Backup;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Actions\Action;
use Illuminate\Support\Facades\Storage;

class BackupResource extends Resource
{
    protected static ?string $model = Backup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('backup_file_path')->label('Ruta del Backup')->searchable(),
                Tables\Columns\TextColumn::make('size')->label('Tamaño'),
                Tables\Columns\TextColumn::make('created_at')->label('Fecha de Creación')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Descargar')
                    ->icon('ri-download-cloud-2-fill')
                    ->action(fn (Backup $record) => response()->download(Storage::path($record->backup_file_path)))
                    ->requiresConfirmation(), // Opcional: Muestra un mensaje de confirmación antes de descargar


                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBackups::route('/'),
        ];
    }

    public static function createBackup(string $type) {
        $options = $type === 'database' ? '--only-db --disable-notifications' : '--disable-notifications';

        //\Artisan::call("backup:run {$options}");
        \Log::info('Intentando ejecutar backup...');
        \Artisan::call('backup:run --only-db --disable-notifications');
        \Log::info('Backup ejecutado, salida: ' . \Artisan::output());

        // Obtener el nombre de la aplicación desde la configuración
        $appName = config('backup.backup.name', 'laravel-backup');

        // Obtener la ruta del backup más reciente
        $backupDisk = config('backup.backup.destination.disks')[0];
        $backupFiles = Storage::disk($backupDisk)->files($appName); // Usa el nombre de la app en la ruta
        $latestBackup = last($backupFiles);

        if ($latestBackup) {
            Backup::create([
                'backup_file_path' => $latestBackup,
                'size' => Storage::disk($backupDisk)->size($latestBackup) . ' bytes',
            ]);
        }
    }

    public static function registerResources(): array
    {
        return [
            BackupResource::class,
        ];
    }
}
