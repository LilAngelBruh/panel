<?php
    require_once '../../../config/conexion.php';

    /* ======= INSERT ALBUM ============ */

    if(isset($_POST['album_titulo_reg'])){
        $titulo = $_POST['album_titulo_reg'];
        $artista = $_POST['select_artista_reg'];
        $genero = $_POST['select_genero_reg'];
        $stock = $_POST['album_stock_reg'];
        $duracion = $_POST['album_duracion_reg'];
        $precio = $_POST['album_precio_reg'];
        $lanzamiento = $_POST['album_lanzamiento_reg'];
        $portada = $_FILES['album_portada_reg'];

        $queryExistencias = "SELECT * FROM albumes WHERE album_titulo LIKE '%$titulo%'";
        $resultadoExistencias = $conexion->query($queryExistencias);

        if($resultadoExistencias->num_rows > 0){
            $alerta = [
                'tipo' => 'warning',
                'titulo' => 'Registro duplicado',
                'mensaje' => 'El album ya se encuentra registrado',
                'action' => 'insert'
            ];
        }else{
            $queryAlbum = "INSERT INTO albumes (album_titulo, album_stock, album_precio, album_lanzamiento, album_duracion)
            VALUES ('$titulo', '$stock', '$precio', '$lanzamiento', '$duracion')";

            $resultadoAlbum = $conexion->query($queryAlbum);

            if($resultadoAlbum){
                $idAlbum = $conexion->insert_id;

                $queryRelacionGeneros = "INSERT INTO albumes_generos (album_id, genero_id) VALUES ($idAlbum, '$genero')";

                $queryRelacionArtistas = "INSERT INTO albumes_artistas (album_id, artista_id) VALUES ($idAlbum, '$artista')";

                $resultadoRelacionGeneros = $conexion->query($queryRelacionGeneros);
                $resultadoRelacionArtistas = $conexion->query($queryRelacionArtistas);

                // Ruta de la carpeta donde se guardarán las imágenes
                $uploadDir = '../../../database/images';
                // Verificar si la carpeta imagenes existe, si no, la crea
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Verificar si la carpeta fotosAlbumes existe, si no, la crea
                $dir = $uploadDir . '/album_fotos';
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }

                // Construir el nombre de archivo
                $nombreDelArchivo = $dir . '/' . $idAlbum . '.jpg';
                // Crear Archivo
                move_uploaded_file($portada['tmp_name'], $nombreDelArchivo);

                $alerta = [
                    'tipo' => 'success',
                    'titulo' => 'Registro exitoso',
                    'mensaje' => 'El album se ha registrado correctamente',
                    'action' => 'insert'
                ];
            }
        }
    }

    /* ======= UPDATE ALBUM ========= */

    if(isset($_POST['album_id_update'])){
        $titulo = $_POST['album_titulo_update'];
        $artista = $_POST['select_artista_update'];
        $genero = $_POST['select_genero_update'];
        $stock = $_POST['album_stock_update'];
        $duracion = $_POST['album_duracion_update'];
        $precio = $_POST['album_precio_update'];
        $lanzamiento = $_POST['album_lanzamiento_update'];
        $portada = $_FILES['album_portada_update'] ? $_FILES['album_portada_update'] : null;

        $estado = isset($_POST['album_estado_update']) ? 0 : 1;

        $id = $_POST['album_id_update'];

        $queryExistencias = "SELECT * FROM albumes WHERE album_titulo LIKE '%$titulo%' AND album_id != $id";
        $resultadoExistencias = $conexion->query($queryExistencias);

        if($resultadoExistencias->num_rows > 0){
            $alerta = [
                'tipo' => 'warning',
                'titulo' => 'Registro duplicado',
                'mensaje' => 'El album ya se encuentra registrado',
                'action' => 'insert'
            ];
        }else{
            $queryAlbum = "UPDATE albumes SET album_titulo = '$titulo', album_stock = '$stock', album_precio = '$precio', album_lanzamiento = '$lanzamiento', album_duracion = '$duracion', album_estado = $estado WHERE album_id = $id";
            $resultadoAlbum = $conexion->query($queryAlbum);
            if($resultadoAlbum){
                $queryRelacionGeneros = "UPDATE albumes_generos SET genero_id = '$genero' WHERE album_id = $id";
                $queryRelacionArtistas = "UPDATE albumes_artistas SET artista_id = '$artista' WHERE album_id = $id";

                $resultadoRelacionGeneros = $conexion->query($queryRelacionGeneros);
                $resultadoRelacionArtistas = $conexion->query($queryRelacionArtistas);

                if($portada != null){
                    // Ruta de la carpeta donde se guardarán las imágenes
                    $uploadDir = '../../../database/images';
                    // Verificar si la carpeta imagenes existe, si no, la crea
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    // Verificar si la carpeta fotosAlbumes existe, si no, la crea
                    $dir = $uploadDir . '/album_fotos';
                    if (!file_exists($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    // Construir el nombre de archivo
                    $nombreDelArchivo = $dir . '/' . $id . '.jpg';
                    // Crear Archivo
                    move_uploaded_file($portada['tmp_name'], $nombreDelArchivo);

                    $alerta = [
                        'tipo' => 'success',
                        'titulo' => 'Actualización exitosa',
                        'mensaje' => 'El album se ha actualizado correctamente',
                        'action' => 'update'
                    ];
                }
            }
        }
    }   

    /* ======= DELETE ALBUM ========= */

    if(isset($_POST['album_id_delete'])){
        $id = $_POST['album_id_delete'];

        $queryDeleteAlbum = "DELETE FROM albumes WHERE album_id = $id";
        $resultadoDeleteAlbum = $conexion->query($queryDeleteAlbum);

        $queryDeleteGeneros = "DELETE FROM albumes_generos WHERE album_id = $id";
        $resultadoDeleteGeneros = $conexion->query($queryDeleteGeneros);

        $queryDeleteArtistas = "DELETE FROM albumes_artistas WHERE album_id = $id";
        $resultadoDeleteArtistas = $conexion->query($queryDeleteArtistas);
        
            $ruta = '../../../database/images/album_fotos/' . $id . '.jpg';
            if(file_exists($ruta)){
                unlink($ruta);
            }

        $alerta = [
            'tipo' => 'success',
            'titulo' => 'Eliminación exitosa',
            'mensaje' => 'El album se ha eliminado correctamente',
            'action' => 'delete'
        ];
    }



    /* REDIRECT */
    header('Location: ../../../albumes');