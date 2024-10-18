<?php

class AutenticacionVista{
    private $usuario = null;

    public function mostrarInicioSesion($error = '') {
        require '../tpe/app/templates/form_inicio_sesion.phtml';
    }
    
}