<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/core/Env.php';
Env::load(__DIR__ . '/.env');
require_once __DIR__ . '/core/config.php';
require_once __DIR__ . '/core/Csrf.php';
require_once __DIR__ . '/core/Recaptcha.php';
require_once __DIR__ . '/core/MailService.php';
require_once __DIR__ . '/vendor/autoload.php';

$controller = $_GET['controller'] ?? 'home';
$action     = $_GET['action'] ?? 'home';

$controllerClass = ucfirst($controller) . 'Controller';

$path1 = 'controllers/' . $controllerClass . '.php';
$path2 = 'decyen/controllers/' . $controllerClass . '.php';

if (file_exists($path1)) {
    require_once $path1;
} elseif (file_exists($path2)) {
    require_once $path2;
} else {
    die("Controller '{$controllerClass}' not found");
}

$controllerObject = new $controllerClass();

if (!method_exists($controllerObject, $action)) {
    die("Action '{$action}' not found in {$controllerClass}");
}

$controllerObject->{$action}();
