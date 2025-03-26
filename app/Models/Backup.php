<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;
    protected $fillable = [
        'backup_file_path',  // Ruta del archivo de backup
    ];

    // Si necesitas métodos adicionales, por ejemplo, para crear un backup
    public static function createBackup($filePath)
    {
        return self::create([
            'backup_file_path' => $filePath,
        ]);
    }
}
