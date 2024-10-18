<?php

require_once '../tpe/app/models/usuario.model.php';
require_once '../tpe/app/views/auth.view.php';

class AuthController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new UsuarioModel();
        $this->view = new AuthView();
    }

    public function showInicioSesion()
    {
        return $this->view->showInicioSesion();
    }

    public function iniciarSesion()
    {
        if (!empty($_POST['nombre']) && !empty($_POST['contrasena'])) {
            $nombre = $_POST['nombre'];
            $contrasena = $_POST['contrasena'];
            $usuarioDB = $this->model->getUsuarioByNombre($nombre);

            if ($usuarioDB && password_verify($contrasena, $usuarioDB->contrasena)) {
                session_start();
                $_SESSION['id_usuario'] = $usuarioDB->id_usuario;
                $_SESSION['dni'] = $usuarioDB->dni;
                error_log('Usuario encontrado: ' . print_r($usuarioDB, true));
                header('Location: ' . BASE_URL);
                exit();
            } else {
                return $this->view->showInicioSesion('Datos incorrectos');
            }
        }
       

    }
    public function cerrarSesion()
    {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL);
    }

}





