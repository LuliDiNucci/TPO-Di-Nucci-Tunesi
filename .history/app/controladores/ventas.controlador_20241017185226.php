<?php
require_once '../tpe/app/models/ventas.model.php';
require_once '../tpe/app/views/ventas.view.php';

class ControladorVentas
{
    private $modelo;
    private $vista;

    private $modeloCategorias;

    private $usuario;

    public function __construct($res)
    {
        $this->modelo = new ModeloVentas();
        $this->vista = new VistaVentas($res->usuario);
        $this->modeloCategorias = new ModeloClientes();
        $this->usuario=$res->usuario;
    }

    public function mostrarVentas()
    {
        $ventas = $this->modelo->obtenerVentas();
        $clientes = $this->ModeloClientes->obtenerClientes();
        return $this->vista->mostrarVentas($ventas, $clientes);
    }
    public function mostrarVenta($id_venta)
    {
        $venta = $this->modelo->obtenerVenta($id_venta);
    
        if ($venta) {
            return $this->vista->mostrarVenta($venta);
        } else {
            header("Location: ../ventas");
            exit; 
        }
    }
    public function agregarVenta()
        {
            $claveForanea = $_POST['clave_foranea'];
            $fechaCompra = $_POST['fecha_compra'];
            $monto = $_POST['monto'];
            $producto = $_POST['producto'];
            $importado = $_POST['importado'];

            $this->model->insertVenta($claveForanea, $fechaCompra, $monto, $producto, $importado);

            header("Location: ././ventas");
            exit; 
        }

    public function borrarVenta($id_venta)
    {
        $venta = $this->model->getVenta($id_venta);
        $this->model->eraseVenta($id_venta);
        
        header("Location: ../ventas");
        exit; 
    }
    
    public function updateVenta($id_venta)
    {
      
        $venta = $this->model->getVenta($id_venta); 
        $clientes = $this->categoriasModel->getCategorias();
        
        if (isset($_POST['producto']) ) {
            
            $fecha_compra = $_POST['fecha_compra'];
            $monto = $_POST['monto'];
            $producto = $_POST['producto'];
            $importado = $_POST['importado'];

            $this->model->updateVenta($id_venta, $fecha_compra, $monto, $producto, $importado);
            header("Location: ../ventas");
            exit;
         
        } else {
            $this->view->showFormEditar($venta, $clientes);
        }
        
    }
    



}