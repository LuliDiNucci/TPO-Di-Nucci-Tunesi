<?php

class VistaClientes {
    private $usuario= null;

    public function __construct($usuario) {
        $this->usuario = $usuario;
    }

    public function mostrarClientes($clientes) {
        $cantidadClientes = count($clientes);

        require '../tpe/app/templates/lista_categorias.phtml';
        if (isset($_SESSION['nombre'])){
            require '../tpe/app/templates/form_categorias.phtml';
        }
        
    }
    public function mostrarCliente($cliente, $ventasCliente){
        $ventas=count($ventasCliente);
        require '../tpe/app/templates/detalle_categoria.phtml';
        require '../tpe/app/templates/lista_ventas_categoria.phtml';
    }
    
    public function mostrarFormularioEditar($cliente) {
        require '../tpe/app/templates/form_editar_categoria.phtml';
    }
    public function mostrarError($error) {
        require '../tpe/app/templates/error.phtml';
    }

}