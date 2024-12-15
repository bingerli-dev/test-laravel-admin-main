<?php

namespace App\Enums;

final class Program
{
    const K22 = 'K22';

    public static function getList(): array
    {
        return [
            self::K22 => 'K22',
        ];
    }
}