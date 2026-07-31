<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

/**
 * Modelo base: CRUD sobre una tabla con consultas preparadas.
 * Ninguna consulta concatena valores en el SQL.
 */
abstract class Model
{
    protected string $table;
    protected array $fillable = [];

    protected function db(): PDO
    {
        return Database::connection();
    }

    public function all(string $orderBy = 'id ASC'): array
    {
        return $this->db()->query("SELECT * FROM {$this->table} ORDER BY {$orderBy}")->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db()->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): int
    {
        $data = $this->onlyFillable($data);
        $cols = array_keys($data);
        $sql  = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->table,
            implode(', ', $cols),
            implode(', ', array_map(static fn ($c) => ':' . $c, $cols))
        );
        $this->db()->prepare($sql)->execute($data);
        return (int) $this->db()->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $data = $this->onlyFillable($data);
        if ($data === []) {
            return false;
        }
        $sets = implode(', ', array_map(static fn ($c) => "{$c} = :{$c}", array_keys($data)));
        $stmt = $this->db()->prepare("UPDATE {$this->table} SET {$sets} WHERE id = :_id");
        return $stmt->execute($data + ['_id' => $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db()->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function count(string $where = '1=1', array $params = []): int
    {
        $stmt = $this->db()->prepare("SELECT COUNT(*) AS c FROM {$this->table} WHERE {$where}");
        $stmt->execute($params);
        return (int) ($stmt->fetch()['c'] ?? 0);
    }

    /** Descarta cualquier campo que no este declarado como asignable. */
    protected function onlyFillable(array $data): array
    {
        return array_intersect_key($data, array_flip($this->fillable));
    }
}
