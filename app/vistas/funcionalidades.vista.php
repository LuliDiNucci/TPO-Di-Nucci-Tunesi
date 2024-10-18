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
        require '../tpe/app/plantillas/error.phtml';
    }


    public function mostrarInicio()
    {
        require '../tpe/app/plantillas/inicio.phtml';
    }
}
