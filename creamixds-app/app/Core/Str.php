<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Funciones de texto con respaldo si la extension mbstring no esta instalada.
 * En algunos hostings compartidos no viene activada, y sin este respaldo
 * el formulario de contacto fallaria con un error fatal.
 */
final class Str
{
    public static function length(string $value): int
    {
        return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
    }

    public static function lower(string $value): string
    {
        return function_exists('mb_strtolower') ? mb_strtolower($value, 'UTF-8') : strtolower($value);
    }

    public static function truncate(string $value, int $limit, string $end = '…'): string
    {
        if (self::length($value) <= $limit) {
            return $value;
        }
        $cut = function_exists('mb_substr') ? mb_substr($value, 0, $limit, 'UTF-8') : substr($value, 0, $limit);
        return rtrim($cut) . $end;
    }
}
