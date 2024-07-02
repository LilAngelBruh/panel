<?php
    require_once '../../../config/conexion.php';

    $pagina = isset($_POST['pagina']) ? (int)$_POST['pagina'] : 1;
    $limite = 10;
    $inicio = ($pagina - 1) * $limite;

    $busquedaEstado = "artista_estado = '1'";
    if (isset($_POST['artista_estado_buscar']) && $_POST['artista_estado_buscar'] == '1') {
        $busquedaEstado = "(artista_estado = '0' OR artista_estado = '1')";
    }

    $busqueda = "";
    if (isset($_POST['artista_buscar']) && !empty($_POST['artista_buscar'])) {
        $busqueda = mysqli_real_escape_string($conexion, $_POST['artista_buscar']);
        $query = "SELECT artistas.artista_id, artistas.artista_nombre, artistas.artista_estado, artistas.artista_registro ,generos.genero_id, generos.genero_nombre  
            FROM artistas 
            INNER JOIN generos_artistas ON artistas.artista_id = generos_artistas.artista_id
            INNER JOIN generos ON generos.genero_id = generos_artistas.genero_id
            WHERE ($busquedaEstado) AND (artistas.artista_id LIKE '%$busqueda%' OR artistas.artista_nombre LIKE '%$busqueda%' OR artistas.artista_estado LIKE '%$busqueda%') 
            ORDER BY artistas.artista_id DESC LIMIT $inicio, $limite";
        $query_total = "SELECT COUNT(*) as total FROM artistas WHERE ($busquedaEstado) AND (artista_id LIKE '%$busqueda%' OR artista_nombre LIKE '%$busqueda%' OR artista_estado LIKE '%$busqueda%')";
    } else {
        $query = "SELECT artistas.artista_id, artistas.artista_nombre, artistas.artista_estado, artistas.artista_registro ,generos.genero_id, generos.genero_nombre  
            FROM artistas 
            INNER JOIN generos_artistas ON artistas.artista_id = generos_artistas.artista_id
            INNER JOIN generos ON generos.genero_id = generos_artistas.genero_id
            WHERE $busquedaEstado 
            ORDER BY artistas.artista_id DESC LIMIT $inicio, $limite";
        $query_total = "SELECT COUNT(*) as total FROM artistas WHERE $busquedaEstado";
    }

    $resultado = mysqli_query($conexion, $query);
    if (!$resultado) {
        echo json_encode(['error' => mysqli_error($conexion)]);
        exit;
    }

    $artistas = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $artistas[] = $row;
    }

    $resultado_total = mysqli_query($conexion, $query_total);
    $total_filas = mysqli_fetch_assoc($resultado_total)['total'];
    $total_paginas = ceil($total_filas / $limite);

    echo json_encode([
        'artistas' => $artistas,
        'total_paginas' => $total_paginas,
        'pagina_actual' => $pagina
    ]);

?>
