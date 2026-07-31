<?php
declare(strict_types=1);

namespace App\Models;

final class Project extends Model
{
    protected string $table = 'projects';
    protected array $fillable = ['emoji', 'tag', 'title', 'description', 'url', 'position', 'is_active'];

    public function published(): array
    {
        return $this->db()
            ->query('SELECT * FROM projects WHERE is_active = 1 ORDER BY position ASC, id ASC')
            ->fetchAll();
    }
}
