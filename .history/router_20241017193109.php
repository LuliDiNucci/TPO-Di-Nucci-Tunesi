<?php
require_once '../tpe/app/libs/respuesta.php';
require_once '../tpe/app/middlewares/aut.sesion.middleware.php';
require_once '../tpe/app/middlewares/verificar.aut.middleware.php';
require_once '../tpe/app/controladores/autenticacion.controlador.php';
require_once '../tpe/app/controladores/ventas.controlador.php';
require_once '../tpe/app/controladores/clientes.controlador.php';
require_once '../tpe/app/controladores/funcionalidades.controlador.php';
require_once '../tpe/config.php';
define('BASE_URL', '');

$res = new Respuesta();

$accion = 'home';
if (!empty($_GET['action'])) {
    $accion = $_GET['action'];
}

$parametros = explode('/', $accion);

switch ($parametros[0]) {
    case 'inicio':
        AutSesionMiddleware($res);
        $controlador = new ControladorFuncionalidades($res);
        $controlador->mostrarInicio();
        break;
    case 'ventas':
        AutSesionMiddleware($res);
        $controlador = new ControladorVentas($res);
        $controlador->mostrarVentas();
        break;
    case 'eliminarVenta':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controlador = new ControladorVentas($res);
        $controlador->borrarVenta($params[1]);
        $controlador->mostrarVentas();
        break;
    case 'agregarVenta':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controlador = new ControladorVentas($res);
        $controlador->agregarVenta();
        $controlador->mostrarVentas();
        break;

    case 'editarVenta':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controlador = new ControladorVentas($res);
        $controlador->editarVenta($params[1]);
        break;

    case 'venta':
        AutSesionMiddleware($res);
        if (!empty($params[1])) {
            $controlador = new ControladorVentas($res);
            $controlador->mostrarVenta($params[1]);
        }
        break;
    case 'clientes':
        AutSesionMiddleware($res);
        $controlador = new ControladorClientes($res);
        $controlador->mostrarClientes();
        break;
    case 'agregarCliente':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controlador = new ControladorClientes($res);
        $controlador->agregarCliente();
        $controlador->mostrarClientes();
        break;
    case 'eliminarCliente':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controlador = new ControladorClientes($res);
        $controlador->borrarCliente($params[1]);
        $controlador->mostrarClientes();
        break;
    case 'editarCliente':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controlador = new ControladorClientes($res);
        $controlador->editarCliente($params[1]);
        break;
    case 'cliente':
        if (!empty($params[1])) {
            $controlador = new ControladorClientes($res);
            $controlador->mostrarCliente($params[1]);
        }
        break;
    case 'mostrarIniciarSesion':
        $controlador = new AutenticacionControlador();
        $controlador->mostrarInicioSesion();
        break;
    case 'inicioSesion':
        $controlador = new AutenticacionControlador();
        $controlador->iniciarSesion();
        break;
    case 'cerrarSesion':
        AutSesionMiddleware($res);
        VerificarAutMiddleware($res);
        $controlador = new AutenticacionControlador();
        $controlador->cerrarSesion();
        break;
    default:
        $controlador = new ControladorFuncionalidades($res);
        $controlador->mostrarDefault("Page not found error 404");
        break;
}
