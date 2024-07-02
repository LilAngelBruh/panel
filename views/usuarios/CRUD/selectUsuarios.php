<?php
    require '../../../config/conexion.php';

    $resultados_por_pagina = 10; // Número de resultados por página

    // Determinar la página actual
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $inicio = ($pagina - 1) * $resultados_por_pagina;

    if (isset($_POST['admin_busqueda'])) {
        $buscar = $conexion->real_escape_string($_POST['admin_busqueda']);
        $query = "SELECT * FROM administradores WHERE administradores_id LIKE '%$buscar%' OR administrador_username LIKE '%$buscar%' OR administrador_email LIKE '%$buscar%' OR administrador_nombre LIKE '%$buscar%' LIMIT $inicio, $resultados_por_pagina";
        $total_query = "SELECT COUNT(*) as total FROM administradores WHERE administradores_id LIKE '%$buscar%' OR administrador_username LIKE '%$buscar%' OR administrador_email LIKE '%$buscar%' OR administrador_nombre LIKE '%$buscar%'";
    } else {
        $query = "SELECT * FROM administradores LIMIT $inicio, $resultados_por_pagina";
        $total_query = "SELECT COUNT(*) as total FROM administradores";
    }

    $resultado = $conexion->query($query);
    $total_resultado = $conexion->query($total_query);

    $total_filas = $total_resultado->fetch_assoc()['total'];
    $total_paginas = ceil($total_filas / $resultados_por_pagina);

    $usuarios = [];

    if ($resultado->num_rows > 0) {
        while ($usuario = $resultado->fetch_assoc()) {
            $usuarios[] = $usuario;
        }
    }

    $response = [
        'usuarios' => $usuarios,
        'total_paginas' => $total_paginas,
        'pagina_actual' => $pagina
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
