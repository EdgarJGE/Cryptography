<?php

require_once "../controladores/pacientes.controlador.php";
require_once "../modelos/pacientes.modelo.php";
require_once "../controladores/cifrar.controlador.php";

class AjaxPacientes{

	/*=======================================
	=            EDITAR PACIENTE            =
	=======================================*/
	
	public $idPaciente;

	public function ajaxEditarPaciente(){

		$item = "idpaciente";
		$valor = $this->idPaciente;

		$respuesta = ControladorPacientes::ctrMostrarPacientes($item, $valor);

		$editarPaciente = Cifrar::decrypt($respuesta[0]["nombre"]);
	   	$editarTelefonoPaciente = Cifrar::decrypt($respuesta[0]["telefono"]);
	   	$editarDireccionPaciente = Cifrar::decrypt($respuesta[0]["direccion"]);
	   	$editarFechaNacimiento = Cifrar::decrypt($respuesta[0]["fecha_nacimiento"]);
	   	$editarSangre = Cifrar::decrypt($respuesta[0]["sangre"]);
	   	$genero = Cifrar::decrypt($respuesta[0]["genero"]);

		$respuestaDes = array("idpaciente" => $respuesta[0]["idpaciente"],
							   "nombre"=>$editarPaciente,
							   "curp"=>$respuesta[0]["curp"],
							   "genero"=>$genero,
					           "telefono"=>$editarTelefonoPaciente,
					           "direccion"=>$editarDireccionPaciente,
					           "fecha_nacimiento"=>$editarFechaNacimiento,
							   "sangre"=>$editarSangre,
							   "foto"=>$respuesta[0]["foto"]);

		echo json_encode($respuestaDes);


	}
	
	/*=====  End of EDITAR PACIENTE  ======*/

	/*===================================================
	=            VALIDAR NO REPETIR PACIENTE            =
	===================================================*/
	
	public $validarCurp;

	public function ajaxValidarPaciente(){

		$item = "curp";
		$valor = $this->validarCurp;

		$respuesta = ControladorPacientes::ctrMostrarPacientes($item, $valor);

		echo json_encode($respuesta);

	}
	
	/*=====  End of VALIDAR NO REPETIR PACIENTE  ======*/
	
	
}

/*=======================================
=            EDITAR PACIENTE            =
=======================================*/

if(isset($_POST["idPaciente"])){

	$paciente = new AjaxPacientes();
	$paciente -> idPaciente = $_POST["idPaciente"];
	$paciente -> ajaxEditarPaciente();

}

/*=====  End of EDITAR PACIENTE  ======*/

/*===================================================
=            VALIDAR NO REPETIR PACIENTE            =
===================================================*/

if(isset( $_POST["validarCurp"])){

	$valPaciente = new AjaxPacientes();
	$valPaciente -> validarCurp = $_POST["validarCurp"];
	$valPaciente -> ajaxValidarPaciente();

}

/*=====  End of VALIDAR NO REPETIR PACIENTE  ======*/

