<?php

require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/View.php';

$router = new Router();
$router->dispatch();
