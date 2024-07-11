<?php
$route = isset($_GET['route']) ? $_GET['route'] : '/';

switch ($route) {
    case '/':
        require_once '../views/home.php';
        break;
    case 'about':
        require_once '../views/about.php';
        break;
    // outras rotas...
    default:
        require_once '../views/404.php';
        break;
}
