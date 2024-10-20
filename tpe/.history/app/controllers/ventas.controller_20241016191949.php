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
            if (!isset($_POST['producto']) || empty($_POST['producto'])) {
                return $this->view->showError('Falta completar el producto');
            }

            $claveForanea = $_POST['clave_foranea'];
            $fechaCompra = $_POST['fecha_compra'];
            $monto = $_POST['monto'];
            $producto = $_POST['producto'];
            $importado = $_POST['importado'];

            $this->model->insertVenta($claveForanea, $fechaCompra, $monto, $producto, $importado);

            header("Location: ././ventas");
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
      
        $cliente = $this->model->getVenta($$id_venta); 
        
        if (isset($_POST['nombre']) ) {
            
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $mail = $_POST['mail'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $imagen = $_POST['imagen'];

            $this->model->updateCategoria($id_categoria, $nombre, $telefono, $mail, $fecha_nacimiento, $imagen);
            header("Location: ../categorias");
            exit;
         
        } else {
            $this->view->showFormEditar( $cliente);
        }
        
    }
    



}