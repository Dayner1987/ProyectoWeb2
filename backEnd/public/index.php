<?php

require __DIR__ . '/../vendor/autoload.php';

use Dell5480\BackEnd\Controllers\AuthController;
use Dell5480\BackEnd\Controllers\DisponibilidadController;
use Dell5480\BackEnd\Controllers\HomeController;
use Dell5480\BackEnd\Controllers\ReservaController;
use Dell5480\BackEnd\Controllers\ServicioController;
use Dell5480\BackEnd\Controllers\UsuarioController;
use Dell5480\BackEnd\Controllers\ServiciosEmpleadoController;

// ======================================================
// NORMALIZAR URI
// ======================================================
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Eliminar prefijo del proyecto
$uri = str_replace('/DisenioWeb2/backEnd/public', '', $uri);

// Quitar espacios y slashes duplicados
$uri = trim($uri);
$uri = rtrim($uri, '/');

// Asegurar que siempre empiece con "/"
if ($uri === '' || $uri[0] !== '/') {
    $uri = '/' . $uri;
}

$method = $_SERVER['REQUEST_METHOD'];

// ======================================================
// ROUTER
// ======================================================

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


    // ======================================================
    // USUARIOS
    // ======================================================
    case ($uri === '/usuarios' && $method === 'GET'):
        (new UsuarioController())->index();
        break;

    case ($uri === '/usuarios/create' && $method === 'POST'):
        (new UsuarioController())->store();
        break;

    case (preg_match('/^\/usuarios\/delete\/(\d+)$/', $uri, $m) && $method === 'POST'):
        (new UsuarioController())->destroy($m[1]);
        break;

    case ($uri === '/usuarios/createUser' && $method === 'POST'):
        (new UsuarioController())->createUser();
        break;

    case (preg_match('/^\/usuarios\/update\/(\d+)$/', $uri, $m) && $method === 'POST'):
        (new UsuarioController())->update($m[1]);
        break;

    case ($uri === '/register'):
        require __DIR__ . '/../app/Views/register.php';
        break;


    // ======================================================
    // SERVICIOS
    // ======================================================
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

    // Servicios asignados a un empleado
    case ($uri === '/servicios/empleado' && $method === 'GET'):
        (new ServicioController())->getByEmpleadoJSON();
        break;


    // ======================================================
    // SERVICIOS - EMPLEADO
    // ======================================================
    case ($uri === '/servicio-empleado' && $method === 'GET'):
        (new ServiciosEmpleadoController())->index();
        break;

    case ($uri === '/servicio-empleado/add' && $method === 'POST'):
        (new ServiciosEmpleadoController())->add();
        break;

    case (preg_match('/^\/servicio-empleado\/remove\/(\d+)$/', $uri, $m) && $method === 'POST'):
        (new ServiciosEmpleadoController())->remove($m[1]);
        break;
// GET empleados por servicio
case (preg_match('/^\/servicio-empleado\/servicio\/(\d+)$/', $uri, $matches) && $method === 'GET'):
    (new ServiciosEmpleadoController())->getByServicio($matches[1]);
    break;



    // ======================================================
// DISPONIBILIDADES
// ======================================================
case ($uri === '/disponibilidades' && $method === 'GET'):
    (new DisponibilidadController())->index();
    break;

case ($uri === '/disponibilidades/create' && $method === 'POST'):
    (new DisponibilidadController())->store();
    break;

case (preg_match('/^\/disponibilidades\/delete\/(\d+)$/', $uri, $m) && $method === 'POST'):
    (new DisponibilidadController())->destroy($m[1]);
    break;

// NUEVA RUTA → horas individuales según fecha
case ($uri === '/disponibilidades/horas' && $method === 'GET'):
    (new DisponibilidadController())->horas();
    break;



    // ======================================================
    // RESERVAS
// GET reservas de un cliente: /reservas/cliente/{id}
case (preg_match('/^\/reservas\/cliente\/(\d+)$/', $uri, $matches) && $method === 'GET'):
    (new ReservaController())->cliente($matches[1]);
    break;
case ($uri === '/reservas/create' && $method === 'POST'):
    (new ReservaController())->store();
    break;



    // ======================================================
    // EMPRESA
    // ======================================================
    case ($uri === '/empresa' && $method === 'GET'):
        (new \Dell5480\BackEnd\Controllers\EmpresaController())->show();
        break;

    case ($uri === '/empresa/update' && $method === 'POST'):
        (new \Dell5480\BackEnd\Controllers\EmpresaController())->update();
        break;
// DELETE /reservas/{id}
case (preg_match('/^\/reservas\/(\d+)$/', $uri, $matches) && $method === 'DELETE'):
    (new ReservaController())->destroy($matches[1]);
    break;


    // ======================================================
    // DEFAULT
    // ======================================================
    default:
        http_response_code(404);
        echo "404 - Página no encontrada → URI: $uri";
}
