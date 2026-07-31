<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Consultas recibidas desde el formulario de contacto.
 * Reemplaza al archivo contacts.json del backend en Node.
 */
final class Lead extends Model
{
    protected string $table = 'leads';
    protected array $fillable = ['name', 'email', 'company', 'service', 'message', 'ip', 'user_agent', 'status'];

    public function latest(int $limit = 50, ?string $status = null): array
    {
        $sql = 'SELECT * FROM leads';
        $params = [];
        if ($status !== null && $status !== '') {
            $sql .= ' WHERE status = :status';
            $params['status'] = $status;
        }
        $sql .= ' ORDER BY created_at DESC, id DESC LIMIT ' . max(1, min($limit, 500));

        $stmt = $this->db()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function setStatus(int $id, string $status): bool
    {
        $allowed = ['nuevo', 'leido', 'respondido', 'archivado'];
        if (!in_array($status, $allowed, true)) {
            return false;
        }
        $stmt = $this->db()->prepare('UPDATE leads SET status = :s WHERE id = :id');
        return $stmt->execute(['s' => $status, 'id' => $id]);
    }

    /** Limita a 3 envios por IP por hora, para frenar spam automatizado. */
    public function tooManyFrom(string $ip, int $max = 3): bool
    {
        $stmt = $this->db()->prepare(
            "SELECT COUNT(*) AS c FROM leads WHERE ip = :ip AND created_at >= :since"
        );
        $stmt->execute(['ip' => $ip, 'since' => date('Y-m-d H:i:s', time() - 3600)]);
        return (int) ($stmt->fetch()['c'] ?? 0) >= $max;
    }
}
