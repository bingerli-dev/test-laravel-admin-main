<?php

namespace App\Utils;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Helper
{

    public static function generateUUID()
    {
        return str_replace('-', '', Str::uuid());
    }

    public static function hasNestedValue(array $array, string $key, $default = null)
    {
        return Arr::get($array, $key) ?? $default;
    }

    public static function formatDate($date)
    {
        return $date ? date('Y-m-d', strtotime($date)) : null;
    }

    public static function formatDateTime($date)
    {
        return $date ? date('Y-m-d\TH:i:s', strtotime($date)) : null;
    }

    public static function formatUnixTime($date)
    {
        return $date ? date('U', strtotime($date)) : null;
    }
}