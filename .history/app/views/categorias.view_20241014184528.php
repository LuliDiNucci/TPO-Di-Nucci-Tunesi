<?php

class CategoriasView {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showCategorias($clientes) {
        $cantidadClientes = count($clientes);

        require '../tpe/app/templates/lista_categorias.phtml';
        require '../tpe/app/templates/form_categorias.phtml';
    }
    public function showCategoria($cliente, $ventasCategoria){
        $ventas=count($ventasCategoria);
        require '../tpe/app/templates/detalle_categoria.phtml';
        require '../tpe/app/templates/lista_ventas_categoria.phtml';
    }
    
    public function showFormEditar($cliente) {
        require '../tpe/app/templates/lista_ventas.phtml';
        require '../tpe/app/templates/form_venta.phtml';
                    
    }
    public function showError($error) {
        require '../tpe/app/templates/error.phtml';
    }

}