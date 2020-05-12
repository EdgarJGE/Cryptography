<?php

class ControladorVentas{

	/*======================================
	=            MOSTRAR VENTAS            =
	======================================*/
	
	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;
		
	}
	
	/*=====  End of MOSTRAR VENTAS  ======*/

	/*===================================
	=            CREAR VENTA            =
	===================================*/
	
	static public function ctrCrearVenta(){

		if(isset($_POST["nuevaVenta"])){

			/*===============================================================
			=            VALIDAR QUE EXISTA AL MENOS UN SERVICIO            =
			===============================================================*/
			
			if($_POST["listaServicios"] == ""){
 
				echo'<script>
	 
				Swal.fire({
					icon: "error",
					title: "¡Debe de seleccionar al menos un producto!",
					button: "Cerrar"
					}).then((result)=>{
	 
					if(result){
						window.location = "crear-venta";
					}
	 
					})
				</script>';
	 
				return;
			}
			
			/*=====  End of VALIDAR QUE EXISTA AL MENOS UN SERVICIO  ======*/

			/*=========================================
			=            GUARDAR LA COMPRA            =
			=========================================*/
			
			$tabla = "ventas";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_paciente"=>$_POST["seleccionarPaciente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "servicios"=>Cifrar::encrypt($_POST["listaServicios"]),
						   "total"=>$_POST["totalVenta"],
						   "metodo_pago"=>Cifrar::encrypt($_POST["listaMetodoPago"]));

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				Swal.fire({
					  icon: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}
			
			/*=====  End of GUARDAR LA COMPRA  ======*/
			
		}

	}

	/*====================================
	=            EDITAR VENTA            =
	====================================*/
	
	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){

			/*=============================================
			REVISAR SI VIENE SERVICIOS EDITADOS
			=============================================*/

			$tabla = "ventas";

			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			if($_POST["listaServicios"] == ""){

				$listaServicios = $traerVenta["servicios"];

			}else{

				$listaServicios = $_POST["listaServicios"];
				
			}

			/*====================================================
			=            GUARDAR CAMBIOS DE LA COMPRA            =
			====================================================*/

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_paciente"=>$_POST["seleccionarPaciente"],
						   "codigo"=>$_POST["editarVenta"],
						   "servicios"=>Cifrar::encrypt($listaServicios),
						   "total"=>$_POST["totalVenta"],
						   "metodo_pago"=>Cifrar::encrypt($_POST["listaMetodoPago"]));

			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				Swal.fire({
					  icon: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}
			
			/*===========  End of GUARDAR LA COMPRA  =============*/
			
		}

	}
	
	/*=====  End of EDITAR VENTA  ======*/

	/*======================================
	=            ELIMINAR VENTA            =
	======================================*/
	
	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";

			$item = "idventa";
			$valor = $_GET["idVenta"];
			
			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $valor);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  icon: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}		
			
			/*=====  End of ELIMINAR VENTA  ======*/		

		}

	}
	
	/*=====  End of ELIMINAR VENTA  ======*/

	/*=======================================
	=            RANGO DE FECHAS            =
	=======================================*/
	
	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	
	/*=====  End of RANGO DE FECHAS  ======*/

	/*=========================================
	=            SUMA TOTAL VENTAS            =
	=========================================*/
	
	public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}
	
}