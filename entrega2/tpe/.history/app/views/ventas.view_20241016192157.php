<?php

class VentasView {

    public function showVentas($ventas, $clientes) {
        $cantidadVentas = count($ventas);
        $cantidadClientes = count($clientes);
        
        require '../tpe/app/templates/lista_ventas.phtml';
        require '../tpe/app/templates/form_venta.phtml';
    }

    public function showVenta($venta) {
            require '../tpe/app/templates/detalle_venta.phtml';
       
    }

    public function showError($error) {
        require '../tpe/app/templates/error.phtml';
    }
    public function showFormEditar($venta, $clientes) {
        require '../tpe/app/templates/lista_categorias.phtml';
        require '../tpe/app/templates/form_editar_categoria.phtml';
    }

}