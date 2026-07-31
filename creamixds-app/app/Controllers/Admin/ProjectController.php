<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Model;
use App\Models\Project;

final class ProjectController extends ResourceController
{
    protected function model(): Model { return new Project(); }
    protected function title(): string { return 'Proyectos'; }
    protected function slug(): string { return 'proyectos'; }

    protected function fields(): array
    {
        return [
            ['name' => 'title',       'label' => 'Titulo',      'type' => 'text',     'rules' => 'required|max:190'],
            ['name' => 'tag',         'label' => 'Categoria',   'type' => 'text',     'rules' => 'max:60', 'hint' => 'E-commerce, Landing page, Sitio web...'],
            ['name' => 'description', 'label' => 'Descripcion', 'type' => 'textarea', 'rules' => 'required|max:600'],
            ['name' => 'url',         'label' => 'Enlace',      'type' => 'text',     'rules' => 'url|max:255'],
            ['name' => 'emoji',       'label' => 'Emoji',       'type' => 'text',     'rules' => 'max:16'],
            ['name' => 'position',    'label' => 'Orden',       'type' => 'number'],
            ['name' => 'is_active',   'label' => 'Visible en el sitio', 'type' => 'checkbox'],
        ];
    }
}
