<?php

class ControladorPacientes{

	/*=======================================
	=            CREAR PACIENTES            =
	=======================================*/
	
	static public function ctrCrearPaciente(){

		if(isset($_POST["nuevoPaciente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoPaciente"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefonoPaciente"]) &&
			   preg_match('/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/', $_POST["nuevoCurp"]) &&
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccionPaciente"])){

			   	/*=============================================
								VALIDAR IMAGEN
				=============================================*/

				$ruta = "vistas/img/pacientes/default/anonymous.png";

				if(isset($_FILES["nuevaImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/pacientes/".$_POST["nuevoCurp"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/pacientes/".$_POST["nuevoCurp"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/pacientes/".$_POST["nuevoCurp"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "pacientes";

				$datos = array("foto" => $ruta,
							   "nombre"=>Cifrar::encrypt($_POST["nuevoPaciente"]),
							   "curp"=>$_POST["nuevoCurp"],
							   "genero"=>Cifrar::encrypt($_POST["nuevoGenero"]),
					           "telefono"=>Cifrar::encrypt($_POST["nuevoTelefonoPaciente"]),
					           "direccion"=>Cifrar::encrypt($_POST["nuevaDireccionPaciente"]),
					           "fecha_nacimiento"=>Cifrar::encrypt($_POST["nuevaFechaNacimiento"]),
							   "sangre"=>Cifrar::encrypt($_POST["nuevaSangre"]));

				$respuesta = ModeloPacientes::mdlIngresarPaciente($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El paciente ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "pacientes";

						}

					});
				
					</script>';

				}

			}else{

				echo'<script>

					Swal.fire({
						  icon: "error",
						  title: "¡El paciente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "pacientes";

							}
						})

			  	</script>';

			}

		}

	}
	
	/*=====  End of CREAR PACIENTES  ======*/

	/*=========================================
	=            MOSTRAR PACIENTES            =
	=========================================*/
	
	static public function ctrMostrarPacientes($item, $valor){

		$tabla = "pacientes";

		$respuesta = ModeloPacientes::mdlMostrarPacientes($tabla, $item, $valor);

		return $respuesta;
		
	}
	
	/*=====  End of MOSTRAR PACIENTES  ======*/

	/*======================================
	=            EDITAR CLIENTE            =
	======================================*/
	
	static public function ctrEditarPaciente(){

		if(isset($_POST["editarPaciente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarPaciente"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefonoPaciente"]) &&
			   preg_match('/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/', $_POST["editarCurp"]) &&
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccionPaciente"])){

			   	/*=============================================
								VALIDAR IMAGEN
				=============================================*/

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["imagenActual"];

				if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/pacientes/".$_POST["editarCurp"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/pacientes/default/anonymous.png"){

						unlink($_POST["imagenActual"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/pacientes/".$_POST["editarCurp"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/pacientes/".$_POST["editarCurp"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "pacientes";

				$datos = array("foto" => $ruta,
							   "nombre"=>Cifrar::encrypt($_POST["editarPaciente"]),
							   "curp"=>$_POST["editarCurp"],
							   "genero"=>Cifrar::encrypt($_POST["editarGenero"]),
					           "telefono"=>Cifrar::encrypt($_POST["editarTelefonoPaciente"]),
					           "direccion"=>Cifrar::encrypt($_POST["editarDireccionPaciente"]),
					           "fecha_nacimiento"=>Cifrar::encrypt($_POST["editarFechaNacimiento"]),
							   "sangre"=>Cifrar::encrypt($_POST["editarSangre"]));

				$respuesta = ModeloPacientes::mdlEditarPaciente($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El paciente ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "pacientes";

						}

					});
				
					</script>';

				}

			}else{

				echo'<script>

					Swal.fire({
						  icon: "error",
						  title: "¡El paciente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "pacientes";

							}
						})

			  	</script>';

			}

		}

	}
	
	/*=====  End of EDITAR CLIENTE  ======*/

	/*=========================================
	=            ELIMINAR PACIENTE            =
	=========================================*/
	
	static public function ctrEliminarPaciente(){

		if(isset($_GET["idPaciente"])){

			$tabla ="pacientes";
			$datos = $_GET["idPaciente"];

			if($_GET["foto"] != "" && $_GET["foto"] != "vistas/img/pacientes/default/anonymous.png"){

				unlink($_GET["foto"]);
				rmdir('vistas/img/pacientes/'.$_GET["curp"]);

			}

			$respuesta = ModeloPacientes::mdlEliminarPaciente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  icon: "success",
					  title: "El paciente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "pacientes";

								}
							})

				</script>';

			}		

		}

	}
	
	/*=====  End of ELIMINAR PACIENTE  ======*/
	
}

