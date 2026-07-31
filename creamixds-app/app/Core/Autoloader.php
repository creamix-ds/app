<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Autoloader PSR-4 minimo: App\Models\Lead -> app/Models/Lead.php
 * Evita tener que hacer require de cada clase a mano.
 */
final class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register(static function (string $class): void {
            $prefix = 'App\\';
            if (!str_starts_with($class, $prefix)) {
                return;
            }
            $relative = substr($class, strlen($prefix));
            $path = BASE_PATH . '/app/' . str_replace('\\', '/', $relative) . '.php';
            if (is_file($path)) {
                require_once $path;
            }
        });
    }
}
