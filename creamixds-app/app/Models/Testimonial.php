<?php
declare(strict_types=1);

namespace App\Models;

final class Testimonial extends Model
{
    protected string $table = 'testimonials';
    protected array $fillable = ['avatar', 'quote', 'author', 'role', 'position', 'is_active'];

    public function published(): array
    {
        return $this->db()
            ->query('SELECT * FROM testimonials WHERE is_active = 1 ORDER BY position ASC, id ASC')
            ->fetchAll();
    }
}
