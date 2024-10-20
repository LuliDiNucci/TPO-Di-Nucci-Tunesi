<?php

class VentasView {
    private $user = null;

    public function __construct($usuario) {
        $this->usuario = $usuario;
    }


    
    public function showVentas($ventas, $clientes) {
        $cantidadVentas = count($ventas);
        $cantidadClientes = count($clientes);
        $usuario = $this->user;
        require '../tpe/app/templates/lista_ventas.phtml';
        if (isset($_SESSION['nombre'])){
            require '../tpe/app/templates/form_venta.phtml';
        }
        
    }

    public function showVenta($venta) {
            require '../tpe/app/templates/detalle_venta.phtml';
       
    }

    public function showError($error) {
        require '../tpe/app/templates/error.phtml';
    }
    public function showFormEditar($venta, $clientes) {
        $cantidadClientes = count($clientes);
        require '../tpe/app/templates/form_editar_venta.phtml';
    }

}