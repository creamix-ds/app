<?php
declare(strict_types=1);

namespace App\Core;

final class View
{
    /**
     * Renderiza una vista dentro de un layout.
     * La vista se captura en un buffer y se inyecta como $slot en el layout.
     */
    public static function render(string $view, array $data = [], string $layout = 'layouts/public'): void
    {
        $file = BASE_PATH . '/app/Views/' . $view . '.php';
        if (!is_file($file)) {
            throw new \RuntimeException("Vista no encontrada: {$view}");
        }

        extract($data, EXTR_SKIP);

        ob_start();
        require $file;
        $slot = ob_get_clean();

        $layoutFile = BASE_PATH . '/app/Views/' . $layout . '.php';
        if (is_file($layoutFile)) {
            require $layoutFile;
        } else {
            echo $slot;
        }
    }

    /** Escape para HTML. Se usa como e() en todas las vistas. */
    public static function e(mixed $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

function e(mixed $value): string
{
    return View::e($value);
}
