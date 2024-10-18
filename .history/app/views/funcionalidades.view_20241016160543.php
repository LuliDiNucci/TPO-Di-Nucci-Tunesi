<?php

class FuncionalidadesView {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }
public function showHome() {
    require '../tpe/app/templates/home.phtml;
}

