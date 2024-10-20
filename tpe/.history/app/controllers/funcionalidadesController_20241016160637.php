<?php
class FuncionalidadesController{
    private $view;


    public function __construct($res)
    {
        $this->view = new funcionalidadesView($res->usuario);
    }

}