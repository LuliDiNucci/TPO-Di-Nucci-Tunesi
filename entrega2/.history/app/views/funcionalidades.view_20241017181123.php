<?php

class FuncionalidadesView {
    private $usuario = null;

    public function __construct($usuario) {
        $this->usuario = $usuario;
    }

    public function showDefault($error){
        require '../tpe/app/templates/error.phtml';
    }

    
    public function showHome() 
    {
        require '../tpe/app/templates/home.phtml';
    }
}
