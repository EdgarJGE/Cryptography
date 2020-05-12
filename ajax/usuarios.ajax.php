<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/cifrar.controlador.php";

class AjaxUsuarios{

	/*======================================
	=            EDITAR USUARIO            =
	======================================*/
	
	public $idUsuario;

	public function ajaxEditarUsuario(){

		$item = "idusuario";
		$valor = $this->idUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		$editarNombre = Cifrar::decrypt($respuesta["nombre"]);
		$editarDireccion = Cifrar::decrypt($respuesta["direccion"]);
		$editarTelefono = Cifrar::decrypt($respuesta["telefono"]);

		$respuestaDec = array("nombre" => $editarNombre,
							  "usuario" => $respuesta["usuario"],
							  "perfil" => $respuesta["perfil"],
							  "telefono" => $editarTelefono,
							  "direccion" => $editarDireccion,
							  "foto" => $respuesta["foto"],
							  "password" => $respuesta["password"]);

		echo json_encode($respuestaDec);


	}
	
	/*=====  End of EDITAR USUARIO  ======*/

	/*=======================================
	=            ACTIVAR USUARIO            =
	=======================================*/
	
	public $activarUsuario;
	public $activarId;


	public function ajaxActivarUsuario(){

		$tabla = "usuarios";

		$item1 = "estado";
		$valor1 = $this->activarUsuario;

		$item2 = "idusuario";
		$valor2 = $this->activarId;

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

	}
	
	/*=====  End of ACTIVAR USUARIO  ======*/

	/*==================================================
	=            VALIDAR NO REPETIR USUARIO            =
	==================================================*/
	
	public $validarUsuario;

	public function ajaxValidarUsuario(){

		$item = "usuario";
		$valor = $this->validarUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);
	
	/*=====  End of VALIDAR NO REPETIR USUARIO  ======*/

	}
	
}

/*======================================
=            EDITAR USUARIO            =
======================================*/

if (isset($_POST["idUsuario"])) {

	$editar = new AjaxUsuarios();
	$editar -> idUsuario = $_POST["idUsuario"];
	$editar -> ajaxEditarUsuario();

}

/*=====  End of EDITAR USUARIO  ======*/

/*=======================================
=            ACTIVAR USUARIO            =
=======================================*/

if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}

/*=====  End of ACTIVAR USUARIO  ======*/

/*==================================================
=            VALIDAR NO REPETIR USUARIO            =
==================================================*/

if(isset( $_POST["validarUsuario"])){

	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();

}

/*=====  End of VALIDAR NO REPETIR USUARIO  ======*/


