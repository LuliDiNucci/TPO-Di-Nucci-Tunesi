<?php

class VistaClientes {
    private $usuario= null;

    public function __construct($usuario) {
        $this->usuario = $usuario;
    }

    public function mostrarClientes($clientes) {
        $cantidadClientes = count($clientes);

        require '../tpe/app/plantillas/lista_clientes.phtml';
        if (isset($_SESSION['nombre'])){
            require '../tpe/app/plantillas/form_clientes.phtml';
        }
        
    }
    public function mostrarCliente($cliente, $ventasCliente){
        $ventas=count($ventasCliente);
        require '../tpe/app/plantillas/detalle_cliente.phtml';
        require '../tpe/app/plantillas/lista_ventas_cliente.phtml';
    }
    
    public function mostrarFormularioEditar($cliente) {
        require '../tpe/app/plantillas/form_editar_cliente.phtml';
    }
    public function mostrarError($error) {
        require '../tpe/app/plantillas/error.phtml';
    }

}