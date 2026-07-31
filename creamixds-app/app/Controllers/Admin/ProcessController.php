<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Block;
use App\Models\Model;

final class ProcessController extends ResourceController
{
    protected function model(): Model { return new Block(); }
    protected function title(): string { return 'Proceso'; }
    protected function slug(): string { return 'proceso'; }
    protected function defaults(): array { return ['type' => 'process']; }

    protected function items(): array
    {
        return (new Block())->ofType('process', false);
    }

    protected function fields(): array
    {
        return [
            ['name' => 'icon',        'label' => 'Numero de etapa', 'type' => 'text',     'rules' => 'required|max:10', 'hint' => 'Por ejemplo: 01'],
            ['name' => 'title',       'label' => 'Titulo',          'type' => 'text',     'rules' => 'required|max:190'],
            ['name' => 'description', 'label' => 'Descripcion',     'type' => 'textarea', 'rules' => 'required|max:500'],
            ['name' => 'position',    'label' => 'Orden',           'type' => 'number'],
            ['name' => 'is_active',   'label' => 'Visible en el sitio', 'type' => 'checkbox'],
        ];
    }
}
