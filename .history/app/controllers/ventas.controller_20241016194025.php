<?php
require_once '../tpe/app/models/ventas.model.php';
require_once '../tpe/app/views/ventas.view.php';

class VentasController
{
    private $model;
    private $view;

    private $categoriasModel;

    public function __construct()
    {
        $this->model = new VentasModel();
        $this->view = new Ventasview();
        $this->categoriasModel = new CategoriasModel();
    }

    public function showVentas()
    {
        $ventas = $this->model->getVentas();
        $clientes = $this->categoriasModel->getCategorias();
        return $this->view->showVentas($ventas, $clientes);
    }
    public function showVenta($id_venta)
    {
        $venta = $this->model->getVenta($id_venta);
    
        if ($venta) {
            return $this->view->showVenta($venta);
        } else {
            header("Location: ../ventas");
            exit; 
        }
    }
    public function addVenta()
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

    public function eraseVenta($id_venta, $res)
    {
        $venta = $this->model->getVenta($id_venta);
        $this->model->eraseVenta($id_venta, $res->usuario);
        
        header("Location: ../ventas");
        exit; 
    }
    
    public function updateVenta($id_venta, $res)
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