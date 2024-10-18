<?php

require_once '../tpe/app/views/funcionalidades.view.php';
class FuncionalidadesController{
    private $vista;


    public function __construct($res)
    {
        $this->vista = new VistaFuncionalidades($res->usuario);
    }

    public function showHome(){
        $this->view->showHome();
    }

    public function showDefault($error){
        $this->view->showDefault($error);
    }
}