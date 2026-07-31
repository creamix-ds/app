<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Proteccion contra CSRF: todo POST debe traer el token de la sesion.
 */
final class Csrf
{
    public static function token(): string
    {
        $token = Session::get('_csrf');
        if (!is_string($token) || $token === '') {
            $token = bin2hex(random_bytes(32));
            Session::set('_csrf', $token);
        }
        return $token;
    }

    public static function field(): string
    {
        return '<input type="hidden" name="_csrf" value="' . htmlspecialchars(self::token(), ENT_QUOTES) . '">';
    }

    public static function check(?string $sent): bool
    {
        $token = Session::get('_csrf');
        return is_string($token) && is_string($sent) && hash_equals($token, $sent);
    }
}
