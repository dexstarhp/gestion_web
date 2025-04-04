<?php

namespace App\Enums;

enum MovementType: string
{
    case PURCHASE = 'PURCHASE';
    case SALE = 'SALE';
    case ADJUSTMENT = 'ADJUSTMENT';

    public function label(): string
    {
        return match ($this) {
            self::PURCHASE => 'Compra',
            self::SALE => 'Venta',
            self::ADJUSTMENT => 'Ajuste',
        };
    }
}
