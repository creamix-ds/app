<?php
declare(strict_types=1);

namespace App\Core;

use PDO;

/**
 * Conexion PDO unica. Soporta SQLite (desarrollo, sin instalar nada)
 * y MySQL/MariaDB (produccion), definido por DB_DRIVER en .env.
 */
final class Database
{
    private static ?PDO $pdo = null;

    public static function connection(): PDO
    {
        if (self::$pdo instanceof PDO) {
            return self::$pdo;
        }

        $driver = Config::get('DB_DRIVER', 'sqlite');

        if ($driver === 'sqlite') {
            $file = Config::get('DB_SQLITE_PATH', 'storage/database.sqlite');
            $path = str_starts_with($file, '/') ? $file : BASE_PATH . '/' . $file;
            if (!is_dir(dirname($path))) {
                mkdir(dirname($path), 0775, true);
            }
            $pdo = new PDO('sqlite:' . $path, null, null, self::options());
            $pdo->exec('PRAGMA foreign_keys = ON');
        } else {
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                Config::get('DB_HOST', '127.0.0.1'),
                Config::get('DB_PORT', '3306'),
                Config::get('DB_NAME', 'creamixds')
            );
            $pdo = new PDO($dsn, Config::get('DB_USER', 'root'), Config::get('DB_PASS', ''), self::options());
        }

        return self::$pdo = $pdo;
    }

    public static function driver(): string
    {
        return Config::get('DB_DRIVER', 'sqlite');
    }

    private static function options(): array
    {
        return [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
    }
}
