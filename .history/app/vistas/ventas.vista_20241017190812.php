<?php

class VistaVentas {
    private $usuario = null;

    public function __construct($usuario) {
        $this->usuario = $usuario;
    }


    
    public function mostrarVentas($ventas, $clientes) {
        $cantidadVentas = count($ventas);
        $cantidadClientes = count($clientes);
        $usuario = $this->usuario;
        require '../tpe/app/templates/lista_ventas.phtml';
        if (isset($_SESSION['nombre'])){
            require '../tpe/app/templates/form_venta.phtml';
        }
        
    }

    public function mostrarVenta($venta) {
            require '../tpe/app/templates/detalle_venta.phtml';
       
    }

    public function mostrarError($error) {
        require '../tpe/app/templates/error.phtml';
    }
    public function mostrarFormEditar($venta, $clientes) {
        $cantidadClientes = count($clientes);
        require '../tpe/app/templates/form_editar_venta.phtml';
    }

}