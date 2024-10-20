<?php
class FuncionalidadesController{
    private $view;


    public function __construct($res)
    {
        $this->view = new funcionalidadesView($res->usuario);
    }

    public function showHome(){
        $this->$View->showHome();
    }

    public function showDefault($error){
        $this->view->showDefault($error);
    }
}