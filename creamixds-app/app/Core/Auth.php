<?php
declare(strict_types=1);

namespace App\Core;

use App\Models\User;

final class Auth
{
    public static function attempt(string $email, string $password): bool
    {
        $user = (new User())->findByEmail($email);

        // password_verify siempre se ejecuta para que el tiempo de respuesta
        // no revele si el email existe o no.
        $hash = $user['password_hash'] ?? '$2y$12$invalidinvalidinvalidinvalidinvalidinvalidinvalidinvalidin';

        if (!password_verify($password, $hash) || $user === null) {
            return false;
        }

        session_regenerate_id(true);
        Session::set('user_id', (int) $user['id']);
        Session::set('user_name', $user['name']);
        return true;
    }

    public static function check(): bool
    {
        return Session::get('user_id') !== null;
    }

    public static function user(): ?array
    {
        $id = Session::get('user_id');
        return $id === null ? null : (new User())->find((int) $id);
    }

    public static function logout(): void
    {
        Session::destroy();
    }
}
