<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Core\Str;
use App\Core\Validator;
use App\Models\Model;

/**
 * Controlador CRUD reutilizable. Cada recurso del panel solo declara
 * su modelo, su titulo y los campos del formulario: el alta, la edicion,
 * el listado y el borrado son iguales para todos.
 */
abstract class ResourceController extends Controller
{
    abstract protected function model(): Model;

    /** @return array<int, array{name:string,label:string,type?:string,rules?:string,options?:array,hint?:string}> */
    abstract protected function fields(): array;

    abstract protected function title(): string;

    abstract protected function slug(): string;

    /** Valores forzados al crear (por ejemplo, el tipo de bloque). */
    protected function defaults(): array
    {
        return [];
    }

    protected function listOrder(): string
    {
        return 'position ASC, id ASC';
    }

    protected function items(): array
    {
        return $this->model()->all($this->listOrder());
    }

    public function index(Request $request): void
    {
        $this->view('admin/resource/index', [
            'title'  => $this->title(),
            'slug'   => $this->slug(),
            'fields' => $this->fields(),
            'items'  => $this->items(),
            'ok'     => Session::flash('success'),
        ], 'layouts/admin');
    }

    public function create(Request $request): void
    {
        $this->form(null);
    }

    public function edit(Request $request, string $id): void
    {
        $item = $this->model()->find((int) $id);
        if ($item === null) {
            $this->redirect('/admin/' . $this->slug());
        }
        $this->form($item);
    }

    private function form(?array $item): void
    {
        $this->view('admin/resource/form', [
            'title'  => ($item === null ? 'Nuevo' : 'Editar') . ' — ' . $this->title(),
            'slug'   => $this->slug(),
            'fields' => $this->fields(),
            'item'   => $item,
            'errors' => Session::flash('errors') ?? [],
            'old'    => Session::flash('old') ?? [],
        ], 'layouts/admin');
    }

    public function store(Request $request): void
    {
        $this->save($request, null);
    }

    public function update(Request $request, string $id): void
    {
        $this->save($request, (int) $id);
    }

    private function save(Request $request, ?int $id): void
    {
        $this->guardCsrf($request);

        $data = [];
        foreach ($this->fields() as $field) {
            $name = $field['name'];
            $data[$name] = $field['type'] === 'checkbox'
                ? ($request->input($name) !== null ? 1 : 0)
                : (string) $request->input($name, '');
        }

        $validator = new Validator($data);
        foreach ($this->fields() as $field) {
            if (!empty($field['rules'])) {
                $validator->check($field['name'], Str::lower($field['label']), $field['rules']);
            }
        }

        if ($validator->fails()) {
            Session::flash('errors', $validator->errors());
            Session::flash('old', $data);
            $this->redirect('/admin/' . $this->slug() . ($id === null ? '/nuevo' : "/{$id}/editar"));
        }

        if ($id === null) {
            $this->model()->create($data + $this->defaults());
            Session::flash('success', 'Creado correctamente.');
        } else {
            $this->model()->update($id, $data);
            Session::flash('success', 'Cambios guardados.');
        }

        $this->redirect('/admin/' . $this->slug());
    }

    public function destroy(Request $request, string $id): void
    {
        $this->guardCsrf($request);
        $this->model()->delete((int) $id);
        Session::flash('success', 'Elemento eliminado.');
        $this->redirect('/admin/' . $this->slug());
    }
}
