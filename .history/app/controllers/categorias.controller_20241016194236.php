<?php
require_once '../tpe/app/models/categorias.model.php';
require_once '../tpe/app/views/categorias.view.php';

class CategoriasController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new CategoriasModel();
        $this->view = new CategoriasView($res->usuario);
    }

    public function showCategorias()
    {
        $clientes = $this->model->getCategorias();

        return $this->view->showCategorias($clientes);
    }
    public function showCategoria($id_categoria)
    {
        $categoria = $this->model->getCategoria($id_categoria);
        $ventasCategoria = $this->model->getVentasCategoria($id_categoria);

        if ($categoria) {
            $this->view->showCategoria($categoria, $ventasCategoria);
        } else {
            header("Location: ../categorias");
            exit;
        }
    }


    public function addCategoria()
    {
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $mail = $_POST['mail'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $imagen = $_POST['imagen'];

        $this->model->insertCategoria($dni, $nombre, $telefono, $mail, $fecha_nacimiento, $imagen);

        header("Location: ././categorias");
        exit;
    }

    public function eraseCategoria($id_categoria)
    {
        $categoria = $this->model->getCategoria($id_categoria);
        $this->model->eraseCategoria($id_categoria);
        header("Location: ../categorias");
        exit;
    }
    public function updateCategoria($id_categoria)
    {
      
        $cliente = $this->model->getCategoria($id_categoria); 
        
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
