<?php

class ControladorHistorial{

	/*=======================================
	=            CREAR HISTORIAL            =
	=======================================*/
	
	static public function ctrCrearHistorial(){

		if(isset($_POST["nuevoTitulo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTitulo"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ),\r\n ]+$/', $_POST["nuevaDescripcionHistorial"])){

				$tabla = "historial";

				$idPaciente = $_GET["idPaciente"];

				$datos = array("titulo" => Cifrar::encrypt($_POST["nuevoTitulo"]),
							   "descripcion" => Cifrar::encrypt($_POST["nuevaDescripcionHistorial"]));

				$respuesta = ModeloHistorial::mdlIngresarHistorial($tabla, $idPaciente, $datos);

				if($respuesta == "ok"){

					echo'<script>

						Swal.fire({
							  icon: "success",
							  title: "El historial ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					Swal.fire({
						  icon: "error",
						  title: "¡El historial no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "";

							}
						})

			  	</script>';
			}
		}

	}
	
	/*=====  End of CREAR HISTORIAL  ======*/

	/*=========================================
	=            MOSTRAR HISTORIAL            =
	=========================================*/

	static public function ctrMostrarHistorial($item, $valor){

		$tabla = "historial";

		$respuesta = ModeloHistorial::mdlMostrarHistorial($tabla, $item, $valor);

		return $respuesta;
	}
	
	/*=====  End of MOSTRAR HISTORIAL  ======*/

	/*========================================
	=            EDITAR HISTORIAL            =
	========================================*/
	
	static public function ctrEditarHistorial(){

		if(isset($_POST["editarTitulo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTitulo"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ),\r\n ]+$/', $_POST["editarDescripcionHistorial"])){

				$tabla = "historial";

				$idPaciente = $_GET["idPaciente"];

				$idhis = $_POST["idEditarHistorial"];

				$datos = array("idhistorial" => $_POST["idEditarHistorial"],
							   "titulo" => Cifrar::encrypt($_POST["editarTitulo"]),
							   "descripcion" => Cifrar::encrypt($_POST["editarDescripcionHistorial"]));

				$respuesta = ModeloHistorial::mdlEditarHistorial($tabla, $idPaciente, $datos);

				if($respuesta == "ok"){

					echo'<script>

						Swal.fire({
							  icon: "success",
							  title: "El historial ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					Swal.fire({
						  icon: "error",
						  title: "¡El historial no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "";

							}
						})

			  	</script>';
			}
		}

	}
	
	/*=====  End of EDITAR HISTORIAL  ======*/

	/*==========================================
	=            ELIMINAR HISTORIAL            =
	==========================================*/
	
	static public function ctrEliminarHistorial(){

		if(isset($_GET["idHistorial"])){

			$tabla ="historial";
			$datos = $_GET["idHistorial"];

			$respuesta = ModeloHistorial::mdlEliminarHistorial($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  icon: "success",
					  title: "El paciente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.history.back();

								}
							})

				</script>';

			}		

		}

	}
	
	
	/*=====  End of ELIMINAR HISTORIAL  ======*/
	
	
	
	





}