<?php

require_once "conexion.php";

class ModeloServicios{

	/*=========================================
	=            MOSTRAR SERVICIOS            =
	=========================================*/
	
	static public function mdlMostrarServicios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY idservicio DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
	
	
	/*=====  End of MOSTRAR SERVICIOS  ======*/

	/*============================================
	=            REGISTRO DE SERVICIO            =
	============================================*/
	
	static public function mdlIngresarServicio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, precio) VALUES (:descripcion, :precio)");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=====  End of REGISTRO DE SERVICIO  ======*/

	/*=======================================
	=            EDITAR SERVICIO            =
	=======================================*/
	
	static public function mdlEditarServicio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, precio = :precio WHERE idservicio = :idservicio");

		$stmt->bindParam(":idservicio", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=====  End of EDITAR SERVICIO  ======*/

	/*=========================================
	=            ELIMINAR SERVICIO            =
	=========================================*/
	
	static public function mdlEliminarServicio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idservicio = :idservicio");

		$stmt->bindParam(":idservicio", $datos, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=====  End of ELIMINAR SERVICIO  ======*/
	
}