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
        require '../tpe/app/plantillas/lista_ventas.phtml';
        if (isset($_SESSION['nombre'])){
            require '../tpe/app/plantillas/form_venta.phtml';
        }
        
    }

    public function mostrarVenta($venta) {
            require '../tpe/app/plantillas/detalle_venta.phtml';
       
    }

    public function mostrarError($error) {
        require '../tpe/app/plantillas/error.phtml';
    }
    public function mostrarFormularioEditar($venta) {
        require '../tpe/app/plantillas/form_editar_venta.phtml';
    }

}