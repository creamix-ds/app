<?php
declare(strict_types=1);

namespace App\Models;

final class User extends Model
{
    protected string $table = 'users';
    protected array $fillable = ['name', 'email', 'password_hash', 'role'];

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db()->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => strtolower($email)]);
        return $stmt->fetch() ?: null;
    }

    public function createWithPassword(string $name, string $email, string $password, string $role = 'admin'): int
    {
        return $this->create([
            'name'          => $name,
            'email'         => strtolower($email),
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role'          => $role,
        ]);
    }

    public function updatePassword(int $id, string $password): bool
    {
        $stmt = $this->db()->prepare('UPDATE users SET password_hash = :h WHERE id = :id');
        return $stmt->execute(['h' => password_hash($password, PASSWORD_DEFAULT), 'id' => $id]);
    }
}
