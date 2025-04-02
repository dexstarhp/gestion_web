<?php
namespace App\Enums;

enum DocumentType: string
{
    case CI = 'ci';
    case NIT = 'nit';
    case OTHER = 'Otro';

    public function label(): string
    {
        return match ($this) {
            self::CI => 'CI',
            self::NIT => 'NIT',
            self::OTHER=> 'OTRO',
        };
    }
}
