<?php

class AuthView{
    private $usuario = null;

    public function showInicioSesion($error = '') {
        require '../tpe/app/templates/form_inicio_sesion.phtml';
    }
    
}