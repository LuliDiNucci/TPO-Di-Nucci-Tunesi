<?php
    function sesionAuthMiddleware($res) { //ESTE MIDDLEWARE VERIFICA SI SOS PUBLICO O ESTAS LOGEADO-SI ESTAS LOGEADO GUARDA SESION SINO NO HAGO NADA!
        session_start();
        if(isset($_SESSION['id_usuario'])){
            $res->usuario = new stdClass();
            $res->usuario->id_usuario = $_SESSION['id_usuario'];
            $res->usuario->nombre = $_SESSION['nombre'] ?? null;
            return;
    }