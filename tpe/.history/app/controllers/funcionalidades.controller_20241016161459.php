<?php

require_once '../tpe/app/views/funcionalidades.view.php';
class FuncionalidadesController{
    private $view;


    public function __construct()
    {
        $this->view = new FuncionalidadesView();
    }

    public function showHome(){
        $this->view->showHome();
    }

    public function showDefault($error){
        $this->view->showDefault($error);
    }
}