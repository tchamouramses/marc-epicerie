<?php

namespace App\Models\Enums;

enum OrderStatusEnum: string
{
    case Paid = 'paid';
    case Unpaid = 'unpaid';
    case Ongoing = 'ongoing';
    case Delivered = 'delivered';

    public static function toArray(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

    public static function toString(): string
    {
        return implode(',', self::toArray());
    }
}
