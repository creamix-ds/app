<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Bloques de contenido repetibles que comparten forma: beneficios,
 * servicios, pasos del proceso y estadisticas. Se distinguen por 'type'.
 */
final class Block extends Model
{
    protected string $table = 'content_blocks';
    protected array $fillable = ['type', 'icon', 'title', 'description', 'position', 'is_active'];

    public function ofType(string $type, bool $onlyActive = true): array
    {
        $sql = 'SELECT * FROM content_blocks WHERE type = :type';
        if ($onlyActive) {
            $sql .= ' AND is_active = 1';
        }
        $sql .= ' ORDER BY position ASC, id ASC';

        $stmt = $this->db()->prepare($sql);
        $stmt->execute(['type' => $type]);
        return $stmt->fetchAll();
    }
}
