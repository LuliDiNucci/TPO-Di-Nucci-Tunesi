<?php
require_once '../tpe/app/models/ventas.model.php';
require_once '../tpe/app/views/ventas.view.php';

class VentasController
{
    private $model;
    private $view;

    private $categoriasModel;

    public function __construct($res)
    {
        $this->model = new VentasModel();
        $this->view = new Ventasview($res->usuario);
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
            if (!isset($_POST['producto']) || empty($_POST['producto'])) {
                return $this->view->showError('Falta completar el producto');
            }

            $claveForanea = $_POST['clave_foranea'];
           // $fechaCompra = $_POST['fecha_compra'];
            $monto = $_POST['monto'];
            $producto = $_POST['producto'];
            $importado = $_POST['importado'];

            $this->model->insertVenta($claveForanea, $monto, $producto, $importado);

            header("Location: ../agregarVenta");
            exit; 
        }

    public function eraseVenta($id_venta)
    {
        $venta = $this->model->getVenta($id_venta);
        $this->model->eraseVenta($id_venta);
        
        header("Location: ../ventas");
        exit; 
    }
    
    public function updateVenta($id_venta)
    {
        $venta = $this->model->getVenta($id_venta);
    
        if (!$venta) {
            return $this->view->showError("No existe la venta con el id_venta=$id_venta");
        }
    
        $fecha_compra = $_POST['fecha_compra'];
        $monto = $_POST['monto'];
        $producto = $_POST['producto'];
        $importado = isset($_POST['importado']) ? 1 : 0;
    
        $this->model->updateVenta($id_venta, $fecha_compra, $monto, $producto, $importado);
    
        //header('Location: ' . VENTAS_URL); ver bien esto!!
        exit;
    }
    



}