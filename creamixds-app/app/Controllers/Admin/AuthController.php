<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;

final class AuthController extends Controller
{
    public function showLogin(Request $request): void
    {
        if (Auth::check()) {
            $this->redirect('/admin');
        }

        $this->view('admin/auth/login', [
            'error' => Session::flash('error'),
        ], 'layouts/blank');
    }

    public function login(Request $request): void
    {
        $this->guardCsrf($request);

        $email    = (string) $request->input('email', '');
        $password = (string) $request->input('password', '');

        if (!Auth::attempt($email, $password)) {
            // Mensaje generico a proposito: no revela si el email existe.
            Session::flash('error', 'Email o contrasena incorrectos.');
            $this->redirect('/admin/login');
        }

        $intended = Session::get('_intended', '/admin');
        Session::forget('_intended');
        $this->redirect(is_string($intended) ? $intended : '/admin');
    }

    public function logout(Request $request): void
    {
        $this->guardCsrf($request);
        Auth::logout();
        $this->redirect('/admin/login');
    }
}
