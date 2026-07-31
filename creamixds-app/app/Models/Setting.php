<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Datos generales del sitio (marca, email, whatsapp, textos SEO)
 * guardados como pares clave/valor para poder editarlos desde el panel.
 */
final class Setting extends Model
{
    protected string $table = 'settings';
    protected array $fillable = ['key_name', 'value', 'label', 'position'];

    public function map(): array
    {
        $out = [];
        foreach ($this->all('position ASC, id ASC') as $row) {
            $out[$row['key_name']] = $row['value'];
        }
        return $out;
    }

    public function saveMany(array $pairs): void
    {
        $stmt = $this->db()->prepare('UPDATE settings SET value = :value WHERE key_name = :key');
        foreach ($pairs as $key => $value) {
            $stmt->execute(['value' => (string) $value, 'key' => $key]);
        }
    }
}
