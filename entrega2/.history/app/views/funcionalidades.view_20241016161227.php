<?php

class FuncionalidadesView {

    public function showDefault($error){
        require '../tpe/app/templates/error.phtml';
    }

    
    public function showHome() 
    {
        require '../tpe/app/templates/home.phtml';
    }
}
