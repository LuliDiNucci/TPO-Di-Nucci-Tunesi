<?php

require_once '../tpe/app/views/funcionalidades.view.php';
class ControladorFuncionalidades{
    private $vista;


    public function __construct($res)
    {
        $this->vista = new VistaFuncionalidades($res->usuario);
    }

    public function mostrarInicio(){
        $this->vista->mostrarInicio();
    }

    public function mostrarDefault($error){
        $this->vista->mostrarDefault($error);
    }
}