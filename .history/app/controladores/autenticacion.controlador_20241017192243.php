<?php

require_once '../tpe/app/modelo/usuario.modelo.php';
require_once '<div class="">
<tpe>
<app>
<vistas>
<autenticacion class="vista"></autenticacion>.php';

class AutenticacionControlador
{
    private $modelo;
    private $vista;

    public function __construct()
    {
        $this->modelo = new ModeloUsuario();
        $this->vista = new AutenticacionVista();
    }

    public function mostrarInicioSesion()
    {
        return $this->vista->mostrarInicioSesion();
    }

    public function iniciarSesion()
    {
        if (empty($_POST['nombre']) && empty($_POST['contrasena'])) {
            return $this->vista->mostrarInicioSesion('Complete sus datos:');
        }

        $nombre = $_POST['nombre'];
        $contrasena = $_POST['contrasena'];
        $usuarioDB = $this->modelo->obetenerUsuarioPorNombre($nombre);


        if ($usuarioDB && password_verify($contrasena, $usuarioDB->contrasena)) {
            session_start();
            $_SESSION['id_usuario'] = $usuarioDB->id_usuario;
            $_SESSION['nombre'] = $usuarioDB->nombre;
            error_log('Usuario encontrado: ' . print_r($usuarioDB, true));
            header('Location: ' . BASE_URL . 'home');
            exit();
        } else {
            return $this->vista->mostrarInicioSesion('Datos incorrectos');
        }

    }
    public function cerrarSesion()
    {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . 'home');
    }

}





