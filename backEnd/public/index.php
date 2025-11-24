<?php

require __DIR__ . '/../vendor/autoload.php';

use Dell5480\BackEnd\Controllers\AuthController;
use Dell5480\BackEnd\Controllers\DisponibilidadController;
use Dell5480\BackEnd\Controllers\HomeController;
use Dell5480\BackEnd\Controllers\ReservaController;
use Dell5480\BackEnd\Controllers\ServicioController;
use Dell5480\BackEnd\Controllers\UsuarioController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/DisenioWeb2/backEnd/public', '', $uri);
$method = $_SERVER['REQUEST_METHOD'];

switch (true) {

    // --- LOGIN ---
    case ($uri === '/' || $uri === '/login'):
        (new AuthController())->login();
        break;

    case ($uri === '/admin'):
        (new HomeController())->admin();
        break;

    case ($uri === '/empleado'):
        (new HomeController())->empleado();
        break;

    case ($uri === '/cliente'):
        (new HomeController())->cliente();
        break;

    // --- USUARIOS ---
    case ($uri === '/usuarios' && $method === 'GET'):
        (new UsuarioController())->index();
        break;

    case ($uri === '/usuarios/create' && $method === 'POST'):
        (new UsuarioController())->store();
        break;

    case (preg_match('/^\/usuarios\/update\/(\d+)$/', $uri, $m) && $method === 'POST'):
        (new UsuarioController())->update($m[1]);
        break;

    case (preg_match('/^\/usuarios\/delete\/(\d+)$/', $uri, $m) && $method === 'POST'):
        (new UsuarioController())->destroy($m[1]);
        break;

    case ($uri === '/register'):
        require __DIR__ . '/../app/Views/register.php';
        break;
        // --- SERVICIOS ---
    case ($uri === '/servicios' && $method === 'GET'):
        (new ServicioController())->index();
        break;

    case ($uri === '/servicios/create' && $method === 'POST'):
        (new ServicioController())->store();
        break;

    case (preg_match('/^\/servicios\/update\/(\d+)$/', $uri, $m) && $method === 'POST'):
        (new ServicioController())->update($m[1]);
        break;

    case (preg_match('/^\/servicios\/delete\/(\d+)$/', $uri, $m) && $method === 'POST'):
        (new ServicioController())->destroy($m[1]);
        break;

    // --- DISPONIBILIDADES ---
    case ($uri === '/disponibilidades' && $method === 'GET'):
        (new DisponibilidadController())->index();
        break;

    case ($uri === '/disponibilidades/create' && $method === 'POST'):
        (new DisponibilidadController())->store();
        break;

    // --- RESERVAS ---
    case ($uri === '/reservas' && $method === 'GET'):
        (new ReservaController())->index();
        break;

    case ($uri === '/reservas/create' && $method === 'POST'):
        (new ReservaController())->store();
        break;
    
            // --- EMPRESA ---
    case ($uri === '/empresa' && $method === 'GET'):
        (new \Dell5480\BackEnd\Controllers\EmpresaController())->show();
        break;

    case ($uri === '/empresa/update' && $method === 'POST'):
        (new \Dell5480\BackEnd\Controllers\EmpresaController())->update();
        break;


    // --- DEFAULT ---
    default:
        http_response_code(404);
        echo "404 - Página no encontrada";
}
