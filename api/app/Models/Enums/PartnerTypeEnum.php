<?php

namespace App\Models\Enums;

enum PartnerTypeEnum: string
{
    case Fournisseur = 'fournisseur';

    public static function toArray(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

    public static function toString(): string
    {
        return implode(',', self::toArray());
    }
}
