<?php
    require '../../../config/conexion.php';

    // Verificar si se recibió una solicitud POST
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_action_artista'])) {
        $IdActualizar = $conexion->real_escape_string($_POST['id_action_artista']);

        $sql = "SELECT artistas.artista_id, artistas.artista_nombre, artistas.artista_estado, artistas.artista_registro ,generos.genero_id FROM artistas
        INNER JOIN generos_artistas ON generos_artistas.artista_id = artistas.artista_id
        INNER JOIN generos ON generos.genero_id = generos_artistas.genero_id
        WHERE artistas.artista_id = $IdActualizar
        LIMIT 1";

        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc(); // Obtener como array asociativo
            echo json_encode($usuario, JSON_UNESCAPED_UNICODE); // Devolver datos como JSON
        } else {
            echo json_encode(array("error" => "No se encontraron datos para el usuario con ID $IdActualizar"), JSON_UNESCAPED_UNICODE);
        }
    }
?>