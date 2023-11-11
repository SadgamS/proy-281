<?php
require_once "conexion.php";

class ModeloCItas{
    	/*=============================================
	CREAR MACANICO
	=============================================*/

	static public function mdlIngresarCita($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha, descripcion, id_cliente) VALUES (:fecha, :descripcion, :id_cliente)");
        
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        
        if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
        
    
    }
    	/*=============================================
	MOSTRAR CITAS
	=============================================*/

	static public function mdlMostrarCitas($tabla, $item, $valor){

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


	/*=============================================
	EDITAR CITA
	=============================================*/

	static public function mdlEditarCita($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha = :fecha, descripcion = :descripcion, id_cliente = :id_cliente  WHERE id_cita = :id_cita");

		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);        
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cita", $datos["id_cita"], PDO::PARAM_INT);
 

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR CITA
	=============================================*/

	static public function mdlEliminarCita($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cita = :id_cita");

		$stmt -> bindParam(":id_cita", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}
	
    
}
