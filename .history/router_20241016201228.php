<?php
require_once '../tpe/app/libs/response.php';
require_once '../tpe/app/middlewares/sesion.auth.middleware.php';
require_once '../tpe/app/controllers/auth.controller.php';
require_once '../tpe/app/controllers/ventas.controller.php';
require_once '../tpe/app/controllers/categorias.controller.php';
require_once '../tpe/app/controllers/funcionalidades.controller.php';
require_once '../tpe/config.php';
define('BASE_URL', '');
define('CATEGORIAS_URL', 'categorias');
define('VENTAS_URL', 'ventas');

$res = new Response();

$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new FuncionalidadesController();
        $controller->showHome();
        break;
    case 'ventas':
        $controller = new VentasController();
        $controller->showVentas();
        break;
    case 'eliminarVenta':
        sesionAuthMiddleware($res);
        $controller = new VentasController();
        $controller->eraseVenta($params[1],$res);
        $controller->showVentas();
        break;
    case 'agregarVenta':
        sesionAuthMiddleware($res);
        $controller = new VentasController();
        $controller->addVenta($res);
        $controller->showVentas();
        break;

    case 'actualizarVenta':
        sesionAuthMiddleware($res);
        $controller = new VentasController();
        $controller->updateVenta($params[1], $res);
        break;

    case 'venta':
        if (!empty($params[1])) {
            $controller = new VentasController();
            $controller->showVenta($params[1]);
        }
        break;
    case 'categorias':
        $controller = new CategoriasController($res);
        $controller->showCategorias();
        break;
    case 'agregarCategoria':
        sesionAuthMiddleware($res);
        $controller = new CategoriasController($res);
        $controller->addCategoria($res);
        $controller->showCategorias();
        break;
    case 'eliminarCategoria':
        sesionAuthMiddleware($res);
        $controller = new CategoriasController();
        $controller->eraseCategoria($params[1],$res);
        $controller->showCategorias();
        break;
    case 'actualizarCategoria':
        sesionAuthMiddleware($res);
        $controller = new CategoriasController();
        $controller->updateCategoria($params[1],$res);
        break;
    case 'categoria':
        if (!empty($params[1])) {
            $controller = new CategoriasController();
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
        $controller = new AuthController();
        $controller->cerrarSesion();
        break;
    default:
        $controller = new FuncionalidadesController();
        $controller->showDefault("Page not found error 404");
        break;
}
