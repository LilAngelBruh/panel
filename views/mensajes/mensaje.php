<?php

    /* 
    
    ARRAY DE ALERTAS

    $alerta 

    'tipo' => 'success' | 'error' | 'warning' | 'info' -> asigarnar el color de la alerta

    'titulo' => 'Titulo de la alerta' -> Titulo de la alerta

    'mensaje' => 'Mensaje de la alerta' -> Mensaje de la alerta

    'action' => 'insert' | 'update' | 'delete' -> Acción que se realizó en la tabla
    
    
    */




    function crearMensaje($alerta) {
        
        if($alerta['action'] == 'insert') {
            if($alerta['tipo'] == 'success') {
                $mensaje= "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>{$alerta['titulo']}</strong> {$alerta['mensaje']}
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }

            if($alerta['tipo'] == 'danger') {
                $mensaje= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>{$alerta['titulo']}</strong> {$alerta['mensaje']}
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }

            if($alerta['tipo'] == 'warning') {
                $mensaje= "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>{$alerta['titulo']}</strong> {$alerta['mensaje']}
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }

        if($alerta['action'] == 'update') {
            if($alerta['tipo'] == 'success') {
                $mensaje= "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>{$alerta['titulo']}</strong> {$alerta['mensaje']}
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }

            if($alerta['tipo'] == 'danger') {
                $mensaje= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>{$alerta['titulo']}</strong> {$alerta['mensaje']}
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }

            if($alerta['tipo'] == 'warning') {
                $mensaje= "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>{$alerta['titulo']}</strong> {$alerta['mensaje']}
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }

        if($alerta['action'] == 'delete') {
            if($alerta['tipo'] == 'success') {
                $mensaje= "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>{$alerta['titulo']}</strong> {$alerta['mensaje']}
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }

            if($alerta['tipo'] == 'danger') {
                $mensaje= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>{$alerta['titulo']}</strong> {$alerta['mensaje']}
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }

            if($alerta['tipo'] == 'warning') {
                $mensaje= "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>{$alerta['titulo']}</strong> {$alerta['mensaje']}
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }

    }