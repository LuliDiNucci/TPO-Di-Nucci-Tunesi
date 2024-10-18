<?php

class AutenticacionVista{
    private $usuario = null;
    var_dump($usuarios);
    public function mostrarInicioSesion($error = '') {
        require '../tpe/app/plantillas/form_inicio_sesion.phtml';
    }
    
}