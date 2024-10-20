<?php
require_once '../tpe/app/libs/respuesta.php';
require_once '../tpe/app/middlewares/aut.sesion.middleware.php';
require_once '../tpe/app/middlewares/verificar.aut.middleware.php';
require_once '../tpe/app/controllers/autenticacion.controlador.php';
require_once '../tpe/app/controllers/ventas.controlador.php';
require_once '../tpe/app/controllers/clientes.controlador.php';
require_once '../tpe/app/controllers/funcionalidades.controlador.php';
require_once '../tpe/config.php';
define('BASE_URL', '');

$res = new Response();

$accion = 'home';
if (!empty($_GET['action'])) {
    $accion = $_GET['action'];
}

$parametros = explode('/', $accion);

switch ($parametros[0]) {
    case 'inicio':
        AutSesionMiddleware($res);
        $controller = new ControladorFuncionalidades($res);
        $controller->mostrarInicio();
        break;
    case 'ventas':
        AutSesionMiddleware($res);
        $controller = new ControladorVentas($res);
        $controller->mostrarVentas();
        break;
    case 'eliminarVenta':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controller = new ControladorVentas($res);
        $controller->borrarVenta($params[1]);
        $controller->mostrarVentas();
        break;
    case 'agregarVenta':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controller = new ControladorVentas($res);
        $controller->agregarVenta();
        $controller->mostrarVentas();
        break;

    case 'actualizarVenta':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controller = new ControladorVentas($res);
        $controller->editarVenta($params[1]);
        break;

    case 'venta':
        AutSesionMiddleware($res);
        if (!empty($params[1])) {
            $controller = new ControladorVentas($res);
            $controller->mostrarVenta($params[1]);
        }
        break;
    case 'clientes':
        AutSesionMiddleware($res);
        $controller = new ControladorClientes($res);
        $controller->mostrarClientes();
        break;
    case 'agregarCliente':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controller = new ControladorClientes($res);
        $controller->agregarCliente();
        $controller->mostrarClientes();
        break;
    case 'eliminarCliente':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controller = new ControladorClientes($res);
        $controller->borrarCliente($params[1]);
        $controller->mostrarClientes();
        break;
    case 'editarCliente':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controller = new ControladorClientes($res);
        $controller->editarCliente($params[1]);
        break;
    case 'cliente':
        if (!empty($params[1])) {
            $controller = new ControladorClientes($res);
            $controller->mostrarCliente($params[1]);
        }
        break;
    case 'mostrarIniciarSesion':
        $controller = new AutenticacionControlador();
        $controller->mostrarInicioSesion();
        break;
    case 'inicioSesion':
        $controller = new AutenticacionControlador();
        $controller->iniciarSesion();
        break;
    case 'cerrarSesion':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controller = new AutenticacionControlador();
        $controller->cerrarSesion();
        break;
    default:
        $controller = new ControladorFuncionalidades($res);
        $controller->mostrarDefault("Page not found error 404");
        break;
}
