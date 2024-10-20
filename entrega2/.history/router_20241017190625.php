<?php
require_once '../tpe/app/libs/response.php';
require_once '../tpe/app/middlewares/sesion.auth.middleware.php';
require_once '../tpe/app/middlewares/verify.auth.middleware.php';
require_once '../tpe/app/controllers/auth.controller.php';
require_once '../tpe/app/controllers/ventas.controller.php';
require_once '../tpe/app/controllers/categorias.controller.php';
require_once '../tpe/app/controllers/funcionalidades.controller.php';
require_once '../tpe/config.php';
define('BASE_URL', '');

$res = new Response();

$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        sesionAuthMiddleware($res);
        $controller = new FuncionalidadesController($res);
        $controller->mostrarInicio();
        break;
    case 'ventas':
        sesionAuthMiddleware($res);
        $controller = new ControladorVentas($res);
        $controller->mostrarVentas();
        break;
    case 'eliminarVenta':
        sesionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ControladorVentas($res);
        $controller->borrarVenta($params[1]);
        $controller->mostrarVentas();
        break;
    case 'agregarVenta':
        sesionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ControladorVentas($res);
        $controller->agregarVenta();
        $controller->mostrarVentas();
        break;

    case 'actualizarVenta':
        sesionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ControladorVentas($res);
        $controller->editarVenta($params[1]);
        break;

    case 'venta':
        sesionAuthMiddleware($res);
        if (!empty($params[1])) {
            $controller = new ControladorVentas($res);
            $controller->showVenta($params[1]);
        }
        break;
    case 'categorias':
        sesionAuthMiddleware($res);
        $controller = new ControladorClientes($res);
        $controller->showCategorias();
        break;
    case 'agregarCategoria':
        sesionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ControladorClientes($res);
        $controller->addCategoria();
        $controller->showCategorias();
        break;
    case 'eliminarCategoria':
        sesionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ControladorClientes($res);
        $controller->eraseCategoria($params[1]);
        $controller->showCategorias();
        break;
    case 'actualizarCategoria':
        sesionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new ControladorClientes($res);
        $controller->updateCategoria($params[1]);
        break;
    case 'categoria':
        if (!empty($params[1])) {
            $controller = new ControladorClientes($res);
            $controller->showCategoria($params[1]);
        }
        break;
    case 'showIniciarSesion':
        $controller = new AuthController();
        $controller->showInicioSesion();
        break;
    case 'inicioSesion':
        $controller = new AuthController();
        $controller->iniciarSesion();
        break;
    case 'cerrarSesion':
        sesionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new AuthController();
        $controller->cerrarSesion();
        break;
    default:
        $controller = new FuncionalidadesController($res);
        $controller->mostrarDefault("Page not found error 404");
        break;
}
