<?php

require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";

class TablaServiciosVentas{

	/*=====================================================
	=            MOSTRAR LA TABLA DE SERVICIOS            =
	=====================================================*/
	
	public function mostrarTablaServiciosVentas(){

		$item = null;
    	$valor = null;

  		$servicios = ControladorServicios::ctrMostrarServicios($item, $valor);

  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($servicios); $i++){

		  	/*============================================
		  	=            TRAEMOS LAS ACCIONES            =
		  	============================================*/
		  	
		  	$botones = "<div class='btn-group'><button class='btn btn-primary agregarServicio recuperarBoton' idServicio='".$servicios[$i]["idservicio"]."'>Agregar</button></div>";
		  	
		  	/*=====  End of TRAEMOS LAS ACCIONES  ======*/
		  	
		  	$datosJson .= '[
		      "'.($i+1).'",
		      "'.$servicios[$i]["descripcion"].'",
		      "$ '.number_format($servicios[$i]["precio"], 2).'",
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

$activarServiciosVentas = new TablaServiciosVentas();
$activarServiciosVentas -> mostrarTablaServiciosVentas();

/*=====  End of ACTIVAR TABLA DE SERVICIOS  ======*/

