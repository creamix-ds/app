<?php
declare(strict_types=1);

/**
 * Front controller. Es el unico archivo PHP accesible desde el navegador:
 * el document root del servidor debe apuntar a esta carpeta (public/).
 */

// Con el servidor embebido (php -S) los archivos que existen se sirven tal cual;
// el resto pasa por la aplicacion. En Apache/Nginx de esto se encarga .htaccess.
if (PHP_SAPI === 'cli-server') {
    $file = __DIR__ . parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    if (is_file($file)) {
        return false;
    }
}

define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/app/Core/Autoloader.php';
App\Core\Autoloader::register();

use App\Core\Config;
use App\Core\Request;
use App\Core\Router;
use App\Core\Session;

Config::load(BASE_PATH . '/.env');

if (Config::bool('APP_DEBUG')) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
    ini_set('error_log', BASE_PATH . '/storage/logs/php.log');
}

Session::start();

$router = new Router();
require BASE_PATH . '/app/routes.php';
$router->dispatch(Request::capture());
