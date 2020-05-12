<?php

require_once "../controladores/historial.controlador.php";
require_once "../modelos/historial.modelo.php";
require_once "../controladores/cifrar.controlador.php";

class AjaxHistorial{

	/*========================================
	=            EDITAR HISTORIAL            =
	========================================*/
	
	public $idHistorial;

	public function ajaxEditarHistorial(){

		$item = "idhistorial";
		$valor = $this->idHistorial;

		$respuesta = ControladorHistorial::ctrMostrarHistorial($item, $valor);

		$titulo = Cifrar::decrypt($respuesta[0]["titulo"]);
		$descripcion = Cifrar::decrypt($respuesta[0]["descripcion"]);

		$respuestaDes = array("idhistorial" => $respuesta[0]["idhistorial"],
							   "titulo"=>$titulo,
							   "descripcion"=>$descripcion);

		echo json_encode($respuestaDes);


	}
	
	
	/*=====  End of EDITAR HISTORIAL  ======*/

}

/*========================================
=            EDITAR HISTORIAL            =
========================================*/

if(isset($_POST["idHistorial"])){

	$historial = new AjaxHistorial();
	$historial -> idHistorial = $_POST["idHistorial"];
	$historial -> ajaxEditarHistorial();

}


/*=====  End of EDITAR HISTORIAL  ======*/
