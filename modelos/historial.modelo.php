<?php

require_once "conexion.php";

class ModeloHistorial{

	/*=======================================
	=            CREAR HISTORIAL            =
	=======================================*/
	
	static public function mdlIngresarHistorial($tabla, $idPaciente, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idpaciente, titulo, descripcion) VALUES (:idpaciente, :titulo, :descripcion)");

		$stmt->bindParam(":idpaciente", $idPaciente, PDO::PARAM_INT);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
	
	/*=====  End of CREAR HISTORIAL  ======*/

	/*=========================================
	=            MOSTRAR HISTORIAL            =
	=========================================*/
	
	static public function mdlMostrarHistorial($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		//Cerramos la conexion
		$stmt -> close();
		
		$stmt = null;

	}
	
	
	/*=====  End of MOSTRAR HISTORIAL  ======*/

	/*========================================
	=            EDITAR HISTORIAL            =
	========================================*/
	
	static public function mdlEditarHistorial($tabla, $idPaciente, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idpaciente = :idpaciente, titulo = :titulo, descripcion = :descripcion WHERE idhistorial = :idhistorial");

		$stmt->bindParam(":idhistorial", $datos["idhistorial"], PDO::PARAM_INT);
		$stmt->bindParam(":idpaciente", $idPaciente, PDO::PARAM_INT);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=====  End of EDITAR HISTORIAL  ======*/

	/*==========================================
	=            ELIMINAR HISTORIAL            =
	==========================================*/
	
	static public function mdlEliminarHistorial($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idhistorial = :idhistorial");
		$stmt->bindParam(":idhistorial", $datos, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		//Cerramos la conexion
		$stmt->close();
		
		$stmt = null;

	}
	
	/*=====  End of ELIMINAR HISTORIAL  ======*/
	
	
	
	

}