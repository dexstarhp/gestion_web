<?php
namespace App\Enums;

enum DocumentType: string
{
    case CI = 'CI';
    case NIT = 'NIT';
    case OTHER = 'OTHER';

    public function label(): string
    {
        return match ($this) {
            self::CI => 'CI',
            self::NIT => 'NIT',
            self::OTHER=> 'OTRO',
        };
    }
}
