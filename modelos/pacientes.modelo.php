<?php

// Solicitamos conexion a la BD
require_once "conexion.php";

class ModeloPacientes{

	/*======================================
	=            CREAR PACIENTE            =
	======================================*/
	
	static public function mdlIngresarPaciente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(foto, nombre, curp, genero, telefono, direccion, fecha_nacimiento, sangre) VALUES (:foto, :nombre, :curp, :genero, :telefono, :direccion, :fecha_nacimiento, :sangre)");

		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":curp", $datos["curp"], PDO::PARAM_STR);
		$stmt->bindParam(":genero", $datos["genero"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":sangre", $datos["sangre"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}
	
	
	/*=====  End of CREAR PACIENTE  ======*/

	/*=========================================
	=            MOSTRAR PACIENTES            =
	=========================================*/
	
	static public function mdlMostrarPacientes($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		
		$stmt = null;

	}
	
	/*=====  End of MOSTRAR PACIENTES  ======*/

	/*=======================================
	=            EDITAR PACIENTE            =
	=======================================*/

	static public function mdlEditarPaciente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET foto = :foto, nombre = :nombre, genero = :genero, telefono = :telefono, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento, sangre = :sangre WHERE curp = :curp ");

		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":curp", $datos["curp"], PDO::PARAM_STR);
		$stmt->bindParam(":genero", $datos["genero"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":sangre", $datos["sangre"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;



	}
	
	/*=====  End of EDITAR PACIENTE  ======*/

	/*=======================================
	=            BORRAR PACIENTE            =
	=======================================*/
	
	static public function mdlEliminarPaciente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idpaciente = :idpaciente");
		$stmt->bindParam(":idpaciente", $datos, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		//Cerramos la conexion
		$stmt->close();
		
		$stmt = null;

	}
	
	/*=====  End of BORRAR PACIENTE  ======*/
	
	
	
}