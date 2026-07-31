<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Block;
use App\Models\Model;

final class StatController extends ResourceController
{
    protected function model(): Model { return new Block(); }
    protected function title(): string { return 'Estadisticas'; }
    protected function slug(): string { return 'estadisticas'; }
    protected function defaults(): array { return ['type' => 'stat']; }

    protected function items(): array
    {
        return (new Block())->ofType('stat', false);
    }

    protected function fields(): array
    {
        return [
            ['name' => 'title',       'label' => 'Numero',  'type' => 'text', 'rules' => 'required|max:20', 'hint' => 'Por ejemplo: +10, 100%, 24/7'],
            ['name' => 'description', 'label' => 'Etiqueta','type' => 'text', 'rules' => 'required|max:120'],
            ['name' => 'position',    'label' => 'Orden',   'type' => 'number'],
            ['name' => 'is_active',   'label' => 'Visible en el sitio', 'type' => 'checkbox'],
        ];
    }
}
