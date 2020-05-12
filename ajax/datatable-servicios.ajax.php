<?php

require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";

class TablaServicios{

	/*=====================================================
	=            MOSTRAR LA TABLA DE SERVICIOS            =
	=====================================================*/
	
	public function mostrarTablaServicios(){

		$item = null;
    	$valor = null;

  		$servicios = ControladorServicios::ctrMostrarServicios($item, $valor);

  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($servicios); $i++){

		  	/*============================================
		  	=            TRAEMOS LAS ACCIONES            =
		  	============================================*/

		  	if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Administrador"){

		  		$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarServicio' idServicio='".$servicios[$i]["idservicio"]."' data-toggle='modal' data-target='#modalEditarServicio'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarServicio' idServicio='".$servicios[$i]["idservicio"]."'><i class='fas fa-times'></i></button></div>";

		  	}else{

		  		$botones = "";

		  	}
		  	
		  	/*=====  End of TRAEMOS LAS ACCIONES  ======*/
		  	
		  	$datosJson .= '[
		      "'.($i+1).'",
		      "'.$servicios[$i]["descripcion"].'",
		      "$ '.number_format($servicios[$i]["precio"], 2).'",
		      "'.$servicios[$i]["fecha"].'",
		      "'.$botones.'"
		    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);
		    
		$datosJson .= ']

		}';

		echo $datosJson;

	}
	
	
	/*=====  End of MOSTRAR LA TABLA DE SERVICIOS  ======*/
	
}

/*==================================================
=            ACTIVAR TABLA DE SERVICIOS            =
==================================================*/

$activarServicios = new TablaServicios();
$activarServicios -> mostrarTablaServicios();

/*=====  End of ACTIVAR TABLA DE SERVICIOS  ======*/

