<?php
    function sesionAuthMiddleware($res) { //ESTE MIDDLEWARE VERIFICA SI SOS PUBLICO O ESTAS LOGEADO-SI ESTAS LOGEADO GUARDA SESION SINO NO HAGO NADA!
        session_start();
        if(isset($_SESSION['id_usuario'])){
            $res->usuario = new stdClass();
            $res->usuario->id_usuario = $_SESSION['id_usuario'];
            $res->usuario->nombre = $_SESSION['nombre'] ?? null;
            return;
        /*} else { 
            header('Location: ' . BASE_URL . 'home');
            die(); SE VA A OTRO MIDDLEWARE*/
        }
    }
/*sion.auth.middleware.php
302 B
<?php
    function sessionAuthMiddleware($res) {
        session_start();
        if(isset($_SESSION['ID_USER'])){
            $res->user = new stdClass();
            $res->user->id = $_SESSION['ID_USER'];
            $res->user->email = $_SESSION['EMAIL_USER'];
            return;
        }
    }
?>*/