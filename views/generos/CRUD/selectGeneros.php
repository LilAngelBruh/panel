<?php

    require_once '../../../config/conexion.php';

    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $limite = 10;
    $inicio = ($pagina - 1) * $limite;

    $busquedaEstado = "";
    if (isset($_POST['genero_estado_buscar']) && $_POST['genero_estado_buscar'] == '1') {
        $busquedaEstado = "(genero_estado = '0' OR genero_estado = '1')";
    } else {
        $busquedaEstado = "genero_estado = '1'";
    }

    $busqueda = "";
    if (isset($_POST['genero_busqueda']) && !empty($_POST['genero_busqueda'])) {
        $busqueda = mysqli_real_escape_string($conexion, $_POST['genero_busqueda']);
        $query = "SELECT * FROM generos WHERE ($busquedaEstado) AND (genero_id LIKE '%$busqueda%' OR genero_nombre LIKE '%$busqueda%' OR genero_estado LIKE '%$busqueda%') ORDER BY genero_id DESC LIMIT $inicio, $limite";
        $query_total = "SELECT COUNT(*) as total FROM generos WHERE ($busquedaEstado) AND (genero_id LIKE '%$busqueda%' OR genero_nombre LIKE '%$busqueda%' OR genero_estado LIKE '%$busqueda%')";
    } else {
        $query = "SELECT * FROM generos WHERE $busquedaEstado ORDER BY genero_id DESC LIMIT $inicio, $limite";
        $query_total = "SELECT COUNT(*) as total FROM generos WHERE $busquedaEstado";
    }

    $resultado = mysqli_query($conexion, $query);
    if (!$resultado) {
        echo json_encode(['error' => mysqli_error($conexion)]);
        exit;
    }

    $generos = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $generos[] = $row;
    }

    $resultado_total = mysqli_query($conexion, $query_total);
    $total_filas = mysqli_fetch_assoc($resultado_total)['total'];
    $total_paginas = ceil($total_filas / $limite);

    echo json_encode([
        'generos' => $generos,
        'total_paginas' => $total_paginas,
        'pagina_actual' => $pagina
    ]);

?>
