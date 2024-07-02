<?php

    require_once '../../../config/conexion.php';

    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $limite = 10;
    $inicio = ($pagina - 1) * $limite;

    $busquedaEstado = "album_estado = '1'";
    if (isset($_POST['album_estado_buscar']) && $_POST['album_estado_buscar'] == '1') {
        $busquedaEstado = "(album_estado = '0' OR album_estado = '1')";
    }

    $busqueda = "";
    if (isset($_POST['album_busqueda']) && !empty($_POST['album_busqueda'])) {
        $busqueda = mysqli_real_escape_string($conexion, $_POST['album_busqueda']);
        
        $query = "
            SELECT 
                albumes.*, 
                artistas.artista_nombre, 
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
                $busquedaEstado AND 
                (albumes.album_titulo LIKE '%$busqueda%' OR 
                artistas.artista_nombre LIKE '%$busqueda%' OR 
                generos.genero_nombre LIKE '%$busqueda%') 
            ORDER BY 
                albumes.album_id DESC 
            LIMIT $inicio, $limite";
        
        $query_total = "
            SELECT 
                COUNT(*) as total 
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
                $busquedaEstado AND 
                (albumes.album_titulo LIKE '%$busqueda%' OR 
                artistas.artista_nombre LIKE '%$busqueda%' OR 
                generos.genero_nombre LIKE '%$busqueda%')";
    } else {
        $query = "
            SELECT 
                albumes.*, 
                artistas.artista_nombre, 
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
                $busquedaEstado 
            ORDER BY 
                albumes.album_id DESC 
            LIMIT $inicio, $limite";
        
        $query_total = "
            SELECT 
                COUNT(*) as total 
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
                $busquedaEstado";
    }

    $resultado = mysqli_query($conexion, $query);
    if (!$resultado) {
        echo json_encode(['error' => mysqli_error($conexion)]);
        exit;
    }

    $albumes = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $albumes[] = $row;
    }

    $resultado_total = mysqli_query($conexion, $query_total);
    $total_filas = mysqli_fetch_assoc($resultado_total)['total'];
    $total_paginas = ceil($total_filas / $limite);

    echo json_encode([
        'albumes' => $albumes,
        'total_paginas' => $total_paginas,
        'pagina_actual' => $pagina
    ]);

?>
