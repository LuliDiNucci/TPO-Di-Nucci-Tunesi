<?php

class FuncionalidadesView {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showDefault($error){
        require '../tpe/app/templates/error.phtml';
    }

    
    public function showHome() 
    {
        require '../tpe/app/templates/home.phtml';
    }
}
