<?php
    function VerificarAutMiddleware($res) {
        if($res->usuario) {
            return;
        } else {
            header('Location: ' . BASE_URL . 'showIniciarSesion');
            die();
        }
    }
?>
