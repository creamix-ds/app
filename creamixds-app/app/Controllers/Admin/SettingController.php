<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Core\Str;
use App\Models\Setting;
use App\Models\User;

final class SettingController extends Controller
{
    public function edit(Request $request): void
    {
        $this->view('admin/settings/edit', [
            'title'    => 'Datos del sitio',
            'settings' => (new Setting())->all('position ASC, id ASC'),
            'ok'       => Session::flash('success'),
            'error'    => Session::flash('error'),
        ], 'layouts/admin');
    }

    public function update(Request $request): void
    {
        $this->guardCsrf($request);

        $pairs = [];
        foreach ((new Setting())->all() as $row) {
            $key = $row['key_name'];
            $value = $request->input('s_' . $key);
            if ($value !== null) {
                $pairs[$key] = $value;
            }
        }

        (new Setting())->saveMany($pairs);
        Session::flash('success', 'Datos del sitio actualizados.');
        $this->redirect('/admin/configuracion');
    }

    public function updatePassword(Request $request): void
    {
        $this->guardCsrf($request);

        $actual = (string) $request->input('actual', '');
        $nueva  = (string) $request->input('nueva', '');

        $user = Auth::user();

        if ($user === null || !password_verify($actual, $user['password_hash'])) {
            Session::flash('error', 'La contrasena actual no es correcta.');
            $this->redirect('/admin/configuracion');
        }

        if (Str::length($nueva) < 10) {
            Session::flash('error', 'La contrasena nueva necesita al menos 10 caracteres.');
            $this->redirect('/admin/configuracion');
        }

        (new User())->updatePassword((int) $user['id'], $nueva);
        Session::flash('success', 'Contrasena actualizada.');
        $this->redirect('/admin/configuracion');
    }
}
