<?php
    require 'config/conexion.php';
    require 'config/app.php';
    include 'views/mensajes/mensaje.php';
    include 'inc/session.php';

    if (isset($_GET['views'])) {
        $url = explode("/", $_GET['views']);
        $vista = $url[0];
    } else {
        $vista = "login";
    }

    if (!verificarSesion() && $vista != "login") {
        header('Location: login');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/head.php' ?>
</head>
<body>
    <?php 
        require_once './controller/viewsController.php';
        $viewsController = new viewsController();
        $vista = $viewsController->obtenerVistasControlador($vista);
        if ($vista == "login" || $vista == "404") {
            require_once './views/' . $vista . '-view.php';
        } else {
        ?>
        
    <?php include 'components/sidebar.php' ?>
    <main>
        <h1>PANEL DE CONTROL</h1>
        <?php require_once $vista ?>
    </main>
        <?php } ?>

    <?php include 'inc/scripts.php' ?>
</body>
</html>
