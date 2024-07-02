<?php

    require_once '../../../config/conexion.php';

    /* ======= INSERT ARTISTA ========= */
    if (isset($_POST['artista_nombre_reg'])) {
        $nombre_artista = $_POST['artista_nombre_reg'];
        $foto_artista = $_FILES['artista_foto_reg'];
        $genero_artista = $_POST['select_genero_reg'];

        $queryExistencia = "SELECT * FROM artistas WHERE artista_nombre = '$nombre_artista'";
        $resultadoExistencia = mysqli_query($conexion, $queryExistencia);
        $numExistencia = mysqli_num_rows($resultadoExistencia);

        if ($numExistencia > 0) {
            $alerta = [
                'tipo' => 'success',
                'titulo' => 'Actualización exitosa',
                'mensaje' => 'El Artista ya existe en la base de datos',
                'action' => 'update'
            ];
        } else {
            $query = "INSERT INTO artistas (artista_nombre) VALUES ('$nombre_artista')";
            $resultado = mysqli_query($conexion, $query);

            if ($resultado) {
                $id_artista = $conexion->insert_id;

                /* Crear relacion */
                $queryGenero = "INSERT INTO generos_artistas (genero_id, artista_id) VALUES ($genero_artista, $id_artista)";
                mysqli_query($conexion, $queryGenero);

                // Ruta de la carpeta donde se guardarán las imágenes
                $uploadDir = '../../../database/images/artistas_fotos';
                // Verificar si la carpeta imagenes existe, si no, la crea
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Construir el nombre de archivo
                $nombreDelArchivo = $uploadDir . '/' . $id_artista . '.jpg';
                // Crear Archivo
                move_uploaded_file($foto_artista['tmp_name'], $nombreDelArchivo);

                $alerta = [
                    'tipo' => 'success',
                    'titulo' => 'Registro exitoso',
                    'mensaje' => 'El Artista se ha registrado correctamente',
                    'action' => 'insert'
                ];
            } else {
                $alerta = [
                    'tipo' => 'danger',
                    'titulo' => 'Error al registrar',
                    'mensaje' => 'El Artista no se ha registrado correctamente',
                    'action' => 'insert'
                ];
            }
        }
    }

    /* ======= UPDATE ARTISTA ========= */
    if (isset($_POST['artista_id_update'])) {
        $id_artista = $_POST['artista_id_update'];
        $nombre_artista = $_POST['artista_nombre_update'];
        $genero_artista = $_POST['select_genero_update'];
        $estado_artista = isset($_POST['artista_estado_update']) ? 0 : 1;
    
        if (isset($_FILES['artista_foto_update']) && $_FILES['artista_foto_update']['error'] == 0) {
            $foto_artista = $_FILES['artista_foto_update'];
        } else {
            $foto_artista = null;
        }
    
        $queryExistencia = "SELECT * FROM artistas WHERE artista_nombre = '$nombre_artista' AND artista_id != $id_artista";
        $resultadoExistencia = mysqli_query($conexion, $queryExistencia);
        $numExistencia = mysqli_num_rows($resultadoExistencia);
    
        if ($numExistencia > 0) {
            $alerta = [
                'tipo' => 'success',
                'titulo' => 'Actualización exitosa',
                'mensaje' => 'El Artista ya existe en la base de datos',
                'action' => 'update'
            ];
        } else {
            $query = "UPDATE artistas SET artista_nombre = '$nombre_artista', artista_estado = $estado_artista WHERE artista_id = $id_artista";
            $resultado = mysqli_query($conexion, $query);
    
            if ($resultado) {
                /* Actualizar relación */
                $queryGenero = "UPDATE generos_artistas SET genero_id = $genero_artista WHERE artista_id = $id_artista";
                mysqli_query($conexion, $queryGenero);
    
                // Verificar si hay nueva foto y actualizarla
                if ($foto_artista) {
                    // Ruta de la carpeta donde se guardarán las imágenes
                    $uploadDir = '../../../database/images/artistas_fotos';
                    // Verificar si la carpeta imagenes existe, si no, la crea
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
    
                    // Construir el nombre de archivo
                    $nombreDelArchivo = $uploadDir . '/' . $id_artista . '.jpg';
                    // Crear Archivo
                    move_uploaded_file($foto_artista['tmp_name'], $nombreDelArchivo);
                }
    
                $alerta = [
                    'tipo' => 'success',
                    'titulo' => 'Actualización exitosa',
                    'mensaje' => 'El Artista se ha actualizado correctamente',
                    'action' => 'update'
                ];
            } else {
                $alerta = [
                    'tipo' => 'danger',
                    'titulo' => 'Error al actualizar',
                    'mensaje' => 'El Artista no se ha actualizado correctamente',
                    'action' => 'update'
                ];
            }
        }
    }


    /* ======= DELETE ARTISTA ========= */
    if (isset($_POST['artista_id_delete'])) {
        $id_artista = $_POST['artista_id_delete'];

        // Consulta para verificar si el artista existe
        $queryExistencia = "SELECT * FROM artistas WHERE artista_id = $id_artista";
        $resultadoExistencia = mysqli_query($conexion, $queryExistencia);
        $numExistencia = mysqli_num_rows($resultadoExistencia);

        if ($numExistencia > 0) {
            // Eliminar relación en la tabla generos_artistas
            $queryDeleteGenero = "DELETE FROM generos_artistas WHERE artista_id = $id_artista";
            mysqli_query($conexion, $queryDeleteGenero);

            // Eliminar el registro del artista en la tabla artistas
            $queryDeleteArtista = "DELETE FROM artistas WHERE artista_id = $id_artista";
            $resultadoDeleteArtista = mysqli_query($conexion, $queryDeleteArtista);

            if ($resultadoDeleteArtista) {
                // Ruta de la carpeta donde se guardan las imágenes
                $uploadDir = '../../../database/images/artistas_fotos';
                // Construir el nombre de archivo
                $nombreDelArchivo = $uploadDir . '/' . $id_artista . '.jpg';

                // Eliminar el archivo de imagen si existe
                if (file_exists($nombreDelArchivo)) {
                    unlink($nombreDelArchivo);
                }

                $alerta = [
                    'tipo' => 'success',
                    'titulo' => 'Eliminación exitosa',
                    'mensaje' => 'El Artista se ha eliminado correctamente',
                    'action' => 'delete'
                ];
            } else {
                $alerta = [
                    'tipo' => 'danger',
                    'titulo' => 'Error al eliminar',
                    'mensaje' => 'El Artista no se ha eliminado correctamente',
                    'action' => 'delete'
                ];
            }
        } else {
            $alerta = [
                'tipo' => 'danger',
                'titulo' => 'Error al eliminar',
                'mensaje' => 'El Artista no existe en la base de datos',
                'action' => 'delete'
            ];
        }
    }

    /* REDIRECT */
    header('Location: ../../../artistas');
