<?php
        require '../../../config/conexion.php';

    // Verificar si se recibió una solicitud POST
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_action_genero'])) {
        $IdActualizar = $conexion->real_escape_string($_POST['id_action_genero']);

        $sql = "SELECT * FROM generos WHERE genero_id = $IdActualizar LIMIT 1";

        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $genero = $resultado->fetch_assoc(); // Obtener como array asociativo
            echo json_encode($genero, JSON_UNESCAPED_UNICODE); // Devolver datos como JSON
        } else {
            echo json_encode(array("error" => "No se encontraron datos para el usuario con ID $IdActualizar"), JSON_UNESCAPED_UNICODE);
        }
    }
?>