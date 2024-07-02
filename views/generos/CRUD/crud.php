<?php
    require_once '../../../config/conexion.php';

    /* ====== REGISTRAR GENERO ======== */
    if (isset($_POST['nombre_genero_reg'])) {
        $nombre_genero = $_POST['nombre_genero_reg'];
        $query = "INSERT INTO generos (genero_nombre) VALUES ('$nombre_genero')";

        $queryExiste = "SELECT * FROM generos WHERE genero_nombre = '$nombre_genero'";
        $resultadoExiste = mysqli_query($conexion, $queryExiste);
        $rowExiste = mysqli_fetch_array($resultadoExiste);

        if ($rowExiste) {
            $alerta = [
                'tipo' => 'success',
                'titulo' => 'Actualización exitosa',
                'mensaje' => 'El Género ya existe en la base de datos',
                'action' => 'update'
            ];
        } else {
            $resultado = mysqli_query($conexion, $query);

            if ($resultado) {
                $alerta = [
                    'tipo' => 'success',
                    'titulo' => 'Registro exitoso',
                    'mensaje' => 'El Género se ha registrado correctamente',
                    'action' => 'insert'
                ];
            } else {
                $alerta = [
                    'tipo' => 'danger',
                    'titulo' => 'Error al registrar',
                    'mensaje' => 'El Género no se ha registrado correctamente',
                    'action' => 'insert'
                ];
            }
        }
    }

    /* ====== ACTUALIZAR GENERO ======== */
    if (isset($_POST['genero_id_update'])) {
        $genero_id = $_POST['genero_id_update'];
        $nombre_genero = $_POST['nombre_genero_update'];
        $estado_genero = isset($_POST['genero_estado_update']) ? 0 : 1;

        $queryExiste = "SELECT * FROM generos WHERE genero_nombre = '$nombre_genero' AND genero_id != $genero_id";
        $resultadoExiste = mysqli_query($conexion, $queryExiste);
        $rowExiste = mysqli_fetch_array($resultadoExiste);

        if ($rowExiste) {
            $alerta = [
                'tipo' => 'success',
                'titulo' => 'Actualización exitosa',
                'mensaje' => 'El Género ya existe en la base de datos',
                'action' => 'update'
            ];
        } else {
            $query = "UPDATE generos SET genero_nombre = '$nombre_genero', genero_estado = $estado_genero WHERE genero_id = $genero_id";
            $resultado = mysqli_query($conexion, $query);

            if ($resultado) {
                $alerta = [
                    'tipo' => 'success',
                    'titulo' => 'Actualización exitosa',
                    'mensaje' => 'El Género se ha actualizado correctamente',
                    'action' => 'update'
                ];
            } else {
                $alerta = [
                    'tipo' => 'danger',
                    'titulo' => 'Error al actualizar',
                    'mensaje' => 'El Género no se ha actualizado correctamente',
                    'action' => 'update'
                ];
            }
        }
    }

    /* ====== BORRAR GENERO ======== */
    if (isset($_POST['genero_id_delete'])) {
        $genero_id = $_POST['genero_id_delete'];
        $query = "DELETE FROM generos WHERE genero_id = $genero_id";
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            $alerta = [
                'tipo' => 'success',
                'titulo' => 'Eliminación exitosa',
                'mensaje' => 'El Género se ha eliminado correctamente',
                'action' => 'delete'
            ];
        } else {
            $alerta = [
                'tipo' => 'danger',
                'titulo' => 'Error al eliminar',
                'mensaje' => 'El Género no se ha eliminado correctamente',
                'action' => 'delete'
            ];
        }
    }

    /* REDIRECT */
    header('Location: ../../../generos');
    exit;
?>
