<?php

    class viewsModel{

        protected function obtenerVistasModelo($vista){
            // Lista blanca de vistas
            $listaBlanca = ["dashboard", "usuarios", "albumes", "artistas", "generos", "pedidos", "reportes"];
            // Si la vista está en la lista blanca
            if (in_array($vista, $listaBlanca)) {
                // Si el archivo de la vista existe
                if (is_file("./views/".$vista. "/" . $vista ."-view.php")) {
                    $contenido = "./views/".$vista. "/" . $vista ."-view.php";
                } else {
                    // Si no existe la vista, se muestra la vista 404
                    $contenido = "404";
                }
            } elseif ($vista == "login" || $vista == "index") {
                $contenido = "login";
            } else {
                $contenido = "404";
            }

            return $contenido;
        }
    }
?>
