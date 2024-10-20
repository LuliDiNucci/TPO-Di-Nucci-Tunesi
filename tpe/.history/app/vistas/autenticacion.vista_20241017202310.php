<?php

class AutenticacionVista{
    private $usuario = null;
    echo $usuarios;
    public function mostrarInicioSesion($error = '') {
        require '../tpe/app/plantillas/form_inicio_sesion.phtml';
    }
    
}