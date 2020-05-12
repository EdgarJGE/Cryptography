<?php

require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";

class AjaxServicios{

	/*=======================================
	=            EDITAR SERVICIO            =
	=======================================*/
	
	public $idServicio;

	public $traerServicios;

	public $nombreServicio;

  	public function ajaxEditarServicio(){

  		if($this->traerServicios == "ok"){

  			$item = null;
	    	$valor = null;

	    	$respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);

	    	echo json_encode($respuesta);


  		}elseif($this->nombreServicio != ""){

  			$item = "descripcion";
		    $valor = $this->nombreServicio;

		    $respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);

		    echo json_encode($respuesta);

  		}else{

  			$item = "idservicio";
		    $valor = $this->idServicio;

		    $respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);

		    echo json_encode($respuesta);

  		}

  	}
	
	/*=====  End of EDITAR SERVICIO  ======*/
	
}

/*=======================================
=            EDITAR SERVICIO            =
=======================================*/

if(isset($_POST["idServicio"])){

  $editarServicio = new AjaxServicios();
  $editarServicio -> idServicio = $_POST["idServicio"];
  $editarServicio -> ajaxEditarServicio();

}

/*=====  End of EDITAR SERVICIO  ======*/

/*=======================================
=            TRAER PRODUCTOS            =
=======================================*/

if(isset($_POST["traerServicios"])){

  $traerServicios = new AjaxServicios();
  $traerServicios -> traerServicios = $_POST["traerServicios"];
  $traerServicios -> ajaxEditarServicio();

}

/*=====  End of TRAER PRODUCTOS  ======*/

/*====================================================
=            TRAER PRODUCTOS DISP MOVILES            =
====================================================*/

if(isset($_POST["nombreServicio"])){

  $traerServicios = new AjaxServicios();
  $traerServicios -> nombreServicio = $_POST["nombreServicio"];
  $traerServicios -> ajaxEditarServicio();

}

/*=====  End of TRAER PRODUCTOS DISP MOVILES  ======*/

