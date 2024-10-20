<?php

class VistaFuncionalidades
{
    private $usuario = null;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    public function mostrarDefault($error)
    {
        require '../tpe/app/templates/error.phtml';
    }


    public function mostrarInicio()
    {
        require '../tpe/app/templates/home.phtml';
    }
}
