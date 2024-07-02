<?php

	require_once "model/viewsModel.php";

	class viewsController extends viewsModel{

		/*---------- Controlador obtener vistas ----------*/
		public function obtenerVistasControlador($vista){
			if($vista != ""){
				$respuesta = $this->obtenerVistasModelo($vista);
			}else{
				$respuesta = "404";
			}
			return $respuesta;
		}
	}
?>
