<?php

class AutenticacionVista{
    private $usuario = null;
    
    public function mostrarInicioSesion($error = '') {
        require '../tpe/app/plantillas/form_inicio_sesion.phtml';
    }
    
}