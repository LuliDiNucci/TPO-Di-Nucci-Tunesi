<?php
    function sesionAuthMiddleware($res) {
        session_start();
        if(isset($_SESSION['id_usuario'])){
            $res->usuario = new stdClass();
            $res->usuario->id_usuario = $_SESSION['id_usuario'];
            $res->usuario->dni = $_SESSION['dni'] ?? null;
            return;
        } else {
            header('Location: ' . BASE_URL . 'showInicioSesion');
            die();
        }
    }
