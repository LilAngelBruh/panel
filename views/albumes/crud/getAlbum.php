<?php
    require_once '../../../config/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_action_album'])) {
        $id = $conexion->real_escape_string($_POST['id_action_album']);
        $querySelectAlbum = "
            SELECT 
                albumes.album_id, 
                albumes.album_titulo, 
                albumes.album_stock, 
                albumes.album_duracion, 
                albumes.album_precio, 
                albumes.album_lanzamiento,
                albumes.album_estado, 
                albumes_artistas.artista_id, 
                artistas.artista_nombre, 
                albumes_generos.genero_id, 
                generos.genero_nombre 
            FROM 
                albumes 
            INNER JOIN 
                albumes_artistas ON albumes.album_id = albumes_artistas.album_id 
            INNER JOIN 
                artistas ON albumes_artistas.artista_id = artistas.artista_id 
            INNER JOIN 
                albumes_generos ON albumes.album_id = albumes_generos.album_id 
            INNER JOIN 
                generos ON albumes_generos.genero_id = generos.genero_id 
            WHERE 
                albumes.album_id = $id";

        $resultadoSelectAlbum = $conexion->query($querySelectAlbum);

        if ($resultadoSelectAlbum->num_rows > 0) {
            $album = $resultadoSelectAlbum->fetch_assoc();
            echo json_encode($album, JSON_UNESCAPED_UNICODE);
        }
    }
?>

