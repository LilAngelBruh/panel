<?php

    function iniciarSesion(){
        session_name(APP_SESSION_NAME);
        session_start();
    }

    function cerrarSesion(){
        session_unset();
        session_destroy();
    }

    function verificarSesion(){
        if (session_status() == PHP_SESSION_NONE) {
            iniciarSesion();
        }
        

        if(isset($_SESSION['token_inicio_sesion'])){
            return true;
        }
        return false;
    }
