<?php
    /* SI HAY UNA SESSION CERRARLA */
    if(isset($_SESSION["token_inicio_sesion"])){
        cerrarSesion();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM administradores WHERE administrador_username = '$username' AND administrador_password = '$password'";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) {
            /* ASIGNAR LOS VALORES */
            $usuario_iniciado = $resultado->fetch_assoc();
            iniciarSesion();
            /* CREAR TOKEN DE INICIO DE SESION */
            $_SESSION["token_inicio_sesion"] = $usuario_iniciado["administradores_id"];
            $_SESSION["nombre_usuario"] = $usuario_iniciado["administrador_nombre"];
            $_SESSION["email_usuario"] = $usuario_iniciado["administrador_email"];
            $_SESSION["foto_usuario"] = "database/images/admin_fotos/" . $usuario_iniciado["administradores_id"] . ".jpg";
            header('Location: usuarios');
            exit();
        }
    }
?>
<link rel="stylesheet" href="assets/css/login.css">
<div class="wrapper">
    <div class="tittle">
        <span>BIENVENIDO ADMINISTRADOR </span>
    </div>
    <form method="POST">
        <div class="row">
            <i class='bx bx-user'></i>
            <input type="text" placeholder="Username" name="username" required>
        </div>
        <div class="row">
            <i class='bx bx-lock'></i>
            <input type="password" placeholder="Password" name="password"required>
        </div>
        <div class="row button">
            <input type="submit" value="Iniciar sesión">
        </div>
    </form>
</div>