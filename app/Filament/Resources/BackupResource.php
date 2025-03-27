<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BackupResource\Pages;
use App\Models\Backup;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction(); // Iniciar transacción

        try {
            $options = $type === 'database' ? '--only-db --disable-notifications' : '--disable-notifications';

            // Ejecutar comando de backup
            \Illuminate\Support\Facades\Artisan::call("backup:run {$options}");

            // Obtener el nombre de la aplicación desde la configuración
            $appName = config('backup.backup.name', 'laravel-backup');

            // Obtener la ruta del backup más reciente
            $backupDisk = config('backup.backup.destination.disks')[0];
            $backupFiles = Storage::disk($backupDisk)->files($appName);

            $latestBackup = last($backupFiles);

            if (!$latestBackup) {
                throw new \Exception('No se encontró un archivo de respaldo.');
            }

            // Guardar en la base de datos
            Backup::create([
                'backup_file_path' => $latestBackup,
                'size' => Storage::disk($backupDisk)->size($latestBackup) . ' bytes',
            ]);

            DB::commit(); // Confirmar la transacción si todo salió bien
        } catch (\Exception $e) {
            DB::rollback(); // Revertir cambios en caso de error
            throw $e; // Lanzar la excepción para que el controlador la maneje
        }
    }

    public static function registerResources(): array
    {
        return [
            BackupResource::class,
        ];
    }
}
