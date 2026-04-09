<?php

require_once __DIR__ . '/../core/Controller.php';

class HomeController extends Controller
{
    public function index(): void
    {
        $siteModel = $this->model('SiteModel');
        $content = $siteModel->getAllContent();

        $this->view('home/index', [
            'content' => $content,
        ]);
    }
}
