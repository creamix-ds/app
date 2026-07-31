<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Block;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Testimonial;

final class HomeController extends Controller
{
    public function index(Request $request): void
    {
        $blocks = new Block();

        $this->view('home/index', [
            'site'         => (new Setting())->map(),
            'benefits'     => $blocks->ofType('benefit'),
            'services'     => $blocks->ofType('service'),
            'process'      => $blocks->ofType('process'),
            'stats'        => $blocks->ofType('stat'),
            'projects'     => (new Project())->published(),
            'testimonials' => (new Testimonial())->published(),
        ]);
    }
}
