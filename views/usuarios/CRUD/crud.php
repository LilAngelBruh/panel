<?php
    
        require '../../../config/conexion.php';
        require '../../../config/app.php';
        require '../../../inc/session.php';
        require '../../mensajes/mensaje.php';
        iniciarSesion();


        /* ====== INSERT USUARIOS ======= */
        if (isset($_POST['admin_reg'])) {
            $admin_username = $_POST['admin_username_reg'];
            $admin_email = $_POST['admin_email_reg'];
            $admin_password = $_POST['admin_password'];
            $admin_nombre = $_POST['admin_nombre_reg'];
            $admin_foto = $_FILES['admin_foto_reg'];
            $fecha_registro = date('Y-m-d');

            $query_existencias = "SELECT * FROM administradores WHERE administrador_username = '$admin_username' OR administrador_email = '$admin_email'";
            $resultado_existencias = $conexion->query($query_existencias);

            if ($resultado_existencias->num_rows > 0) {
                $alerta = [
                    'tipo' => 'warning',
                    'titulo' => 'Registro duplicado',
                    'mensaje' => 'El usuario ya se encuentra registrado',
                    'action' => 'insert'
                ];
            }else{
                $query = "INSERT INTO administradores (administrador_username, administrador_nombre, administrador_email, administrador_password, administrador_registro) 
                VALUES ('$admin_username', '$admin_nombre', '$admin_email', '$admin_password', '$fecha_registro')";
    
                $resultado = $conexion->query($query);
    
                if ($resultado) {
                    $id_admin = $conexion->insert_id;
    
                    // Ruta de la carpeta donde se guardarán las imágenes
                    $uploadDir = '../../../database/images';
                    // Verificar si la carpeta imagenes existe, si no, la crea
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
    
                    // Verificar si la carpeta fotosUsuarios existe, si no, la crea
                    $dir = $uploadDir . '/admin_fotos';
                    if (!file_exists($dir)) {
                        mkdir($dir, 0777, true);
                    }
    
                    // Construir el nombre de archivo
                    $nombreDelArchivo = $dir . '/' . $id_admin . '.jpg';
                    // Crear Archivo
                    move_uploaded_file($admin_foto['tmp_name'], $nombreDelArchivo);
    
                    $alerta = [
                        'tipo' => 'success',
                        'titulo' => 'Registro exitoso',
                        'mensaje' => 'El usuario se ha registrado correctamente',
                        'action' => 'insert'
                    ];
                } else {
                    $alerta = [
                        'tipo' => 'danger',
                        'titulo' => 'Error al registrar',
                        'mensaje' => 'El usuario no se ha registrado correctamente',
                        'action' => 'insert'
                    ];
                }
            }
        }

        /* ====== UPDATE USUARIOS ======= */

        if(isset($_POST['id_admin_update'])){
            $id = $conexion->real_escape_string($_POST['id_admin_update']);
            $username = $conexion->real_escape_string($_POST['admin_username_update']);
            $email = $conexion->real_escape_string($_POST['admin_email_update']);
            $password = $conexion->real_escape_string($_POST['admin_password_update']);
            $nombre = $conexion->real_escape_string($_POST['admin_nombre_update']);
            $foto = $_FILES['admin_foto_update'];

            $query = "UPDATE administradores SET administrador_username = '$username', administrador_email = '$email', administrador_password = '$password', administrador_nombre = '$nombre' WHERE administradores_id = $id";
            $resultado = $conexion->query($query);

            if($resultado){
                if($foto['name'] != ''){
                    if(file_exists('../../../database/images/admin_fotos/' . $id . '.jpg'))
                        unlink('../../../database/images/admin_fotos/' . $id . '.jpg');
                    move_uploaded_file($foto['tmp_name'], '../../../database/images/admin_fotos/' . $id . '.jpg');
                }
                $alerta = [
                    'tipo' => 'success',
                    'titulo' => 'Actualización exitosa',
                    'mensaje' => 'El usuario se ha actualizado correctamente',
                    'action' => 'update'
                ];
            }else{
                $alerta = [
                    'tipo' => 'danger',
                    'titulo' => 'Error al actualizar',
                    'mensaje' => 'El usuario no se ha actualizado correctamente',
                    'action' => 'update'
                ];
            }
        }

        /* ====== DELETE USUARIOS ======= */

        if(isset($_POST['admin_id_eliminar'])){
            $id = $conexion->real_escape_string($_POST['admin_id_eliminar']);
                // Asegúrate de que $id_actual tiene un valor válido
            $id_actual = $_SESSION['token_inicio_sesion'];
            if(empty($id_actual)) {
                die(var_dump($_SESSION));
            }
            $query = "DELETE FROM administradores WHERE administradores_id = $id AND administradores_id != $id_actual";
            $resultado = $conexion->query($query);

            if($resultado && $conexion->affected_rows > 0){
                if(file_exists('../../../database/images/admin_fotos/' . $id . '.jpg'))
                    unlink('../../../database/images/admin_fotos/' . $id . '.jpg');
                $alerta = [
                    'tipo' => 'success',
                    'titulo' => 'Eliminación exitosa',
                    'mensaje' => 'El usuario se ha eliminado correctamente',
                    'action' => 'delete'
                ];
            }else{
                $alerta = [
                    'tipo' => 'danger',
                    'titulo' => 'Error al eliminar',
                    'mensaje' => 'El usuario no se ha eliminado correctamente',
                    'action' => 'delete'
                ];
            }
        }


        /* REDIRECT */
        header('Location: ../../../usuarios');
?>