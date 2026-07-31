<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Lee el archivo .env una sola vez y expone los valores.
 * Nada de credenciales escritas dentro del codigo.
 */
final class Config
{
    private static array $values = [];

    public static function load(string $path): void
    {
        if (!is_file($path)) {
            $example = $path . '.example';
            if (is_file($example)) {
                self::$values = self::parse($example);
                return;
            }
            throw new \RuntimeException('Falta el archivo .env. Copia .env.example a .env.');
        }
        self::$values = self::parse($path);
    }

    private static function parse(string $path): array
    {
        $out = [];
        foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }
            [$key, $value] = array_pad(explode('=', $line, 2), 2, '');
            $value = trim($value);
            // Quitar comentario al final de la linea si el valor no esta entre comillas
            if ($value !== '' && $value[0] !== '"' && $value[0] !== "'") {
                $value = trim(preg_replace('/\s+#.*$/', '', $value));
            }
            $out[trim($key)] = trim($value, "\"'");
        }
        return $out;
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        return self::$values[$key] ?? $default;
    }

    public static function bool(string $key, bool $default = false): bool
    {
        $v = self::$values[$key] ?? null;
        if ($v === null) {
            return $default;
        }
        return in_array(strtolower($v), ['1', 'true', 'yes', 'on'], true);
    }

    public static function all(): array
    {
        return self::$values;
    }
}
