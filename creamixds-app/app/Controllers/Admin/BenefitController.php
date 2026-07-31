<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Block;
use App\Models\Model;

final class BenefitController extends ResourceController
{
    protected function model(): Model { return new Block(); }
    protected function title(): string { return 'Beneficios'; }
    protected function slug(): string { return 'beneficios'; }
    protected function defaults(): array { return ['type' => 'benefit']; }

    protected function items(): array
    {
        return (new Block())->ofType('benefit', false);
    }

    protected function fields(): array
    {
        return [
            ['name' => 'title',       'label' => 'Titulo',      'type' => 'text',     'rules' => 'required|max:190'],
            ['name' => 'description', 'label' => 'Descripcion', 'type' => 'textarea', 'rules' => 'required|max:500'],
            ['name' => 'icon',        'label' => 'Icono',       'type' => 'text'],
            ['name' => 'position',    'label' => 'Orden',       'type' => 'number'],
            ['name' => 'is_active',   'label' => 'Visible en el sitio', 'type' => 'checkbox'],
        ];
    }
}
