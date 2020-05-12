<?php

class ControladorServicios{

	/*=========================================
	=            MOSTRAR SERVICIOS            =
	=========================================*/
	
	static public function ctrMostrarServicios($item, $valor){

		$tabla = "servicios";

		$respuesta = ModeloServicios::mdlMostrarServicios($tabla, $item, $valor);

		return $respuesta;

	}
	
	
	/*=====  End of MOSTRAR SERVICIOS  ======*/

	/*======================================
	=            CREAR SERVICIO            =
	======================================*/
	
	static public function ctrCrearServicio(){

		if(isset($_POST["nuevaDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecio"])){

				$tabla = "servicios";

				$datos = array("descripcion" => $_POST["nuevaDescripcion"],
							   "precio" => $_POST["nuevoPrecio"]);

				$respuesta = ModeloServicios::mdlIngresarServicio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						Swal.fire({
							  icon: "success",
							  title: "El servicio ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "servicios";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					Swal.fire({
						  icon: "error",
						  title: "¡El servicio no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "servicios";

							}
						})

			  	</script>';
			}
		}

	}
	
	/*=====  End of CREAR SERVICIO  ======*/

	/*=======================================
	=            EDITAR SERVICIO            =
	=======================================*/
	
	static public function ctrEditarServicio(){

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecio"])){

				$tabla = "servicios";

				$datos = array("id"=>$_POST["idServicio"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "precio" => $_POST["editarPrecio"]);

				var_dump($datos);

				$respuesta = ModeloServicios::mdlEditarServicio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						Swal.fire({
							  icon: "success",
							  title: "El servicio ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "servicios";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					Swal.fire({
						  icon: "error",
						  title: "¡El servicio no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "servicios";

							}
						})

			  	</script>';
			}
		}

	}
	
	/*=====  End of EDITAR SERVICIO  ======*/

	/*=========================================
	=            ELIMINAR SERVICIO            =
	=========================================*/
	
	static public function ctrEliminarServicio(){

		if(isset($_GET["idServicio"])){

			$tabla = "servicios";
			$datos = $_GET["idServicio"];

			$respuesta = ModeloServicios::mdlEliminarServicio($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  icon: "success",
					  title: "El servicio ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "servicios";

								}
							})

				</script>';

			}

		}

	}
	
	/*=====  End of ELIMINAR SERVICIO  ======*/
		
}

