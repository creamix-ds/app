<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Model;
use App\Models\Testimonial;

final class TestimonialController extends ResourceController
{
    protected function model(): Model { return new Testimonial(); }
    protected function title(): string { return 'Testimonios'; }
    protected function slug(): string { return 'testimonios'; }

    protected function fields(): array
    {
        return [
            ['name' => 'quote',     'label' => 'Testimonio', 'type' => 'textarea', 'rules' => 'required|max:600'],
            ['name' => 'author',    'label' => 'Nombre',     'type' => 'text',     'rules' => 'required|max:120'],
            ['name' => 'role',      'label' => 'Cargo o empresa', 'type' => 'text', 'rules' => 'max:160'],
            ['name' => 'avatar',    'label' => 'Emoji',      'type' => 'text',     'rules' => 'max:16'],
            ['name' => 'position',  'label' => 'Orden',      'type' => 'number'],
            ['name' => 'is_active', 'label' => 'Visible en el sitio', 'type' => 'checkbox'],
        ];
    }
}
