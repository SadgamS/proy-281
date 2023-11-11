<?php

require_once "conexion.php";

class ModeloServicios{

	/*=============================================
	CREAR SERVICIOS
	=============================================*/

	static public function mdlIngresarServicios($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_servicio,costo) VALUES (:servicio,:costo)");

        $stmt->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);
        $stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	/*=============================================
	MOSTRAR SERVICIOS
	=============================================*/

	static public function mdlMostrarServicios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

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

	static public function mdlMostrarServiciosSol(){

			$stmt = Conexion::conectar()->prepare("SELECT nombre_servicio, ifnull(servicios_mas_solicitados(id_servicio),0) as cantidad 
													FROM servicios");

			$stmt -> execute();

			return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

	}


		/*=============================================
	EDITAR SERVICIO	
	=============================================*/

	static public function mdlEditarServicio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_servicio = :nombre_servicio, costo = :costo WHERE id_servicio = :id_servicio");

		$stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_servicio", $datos["nombre_servicio"], PDO::PARAM_STR);
		$stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_INT);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR SERVICIO
	=============================================*/

	static public function mdlEliminarServicio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_servicio = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



}
