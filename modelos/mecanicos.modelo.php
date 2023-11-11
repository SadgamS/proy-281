<?php

require_once "conexion.php";

class ModeloMecanicos{

	/*=============================================
	CREAR MACANICO
	=============================================*/

	static public function mdlIngresarMecanico($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ci, nombre, apellido, telefono, direccion, fecha_ingreso) VALUES (:ci, :nombre, :apellido ,:telefono, :direccion, :fecha_ingreso)");
        
        
        $stmt->bindParam(":ci", $datos["ci"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
       
        
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR MECANICOS
	=============================================*/

	static public function mdlMostrarMecanicos($tabla, $item, $valor){

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

	static public function mdlMostrarCantidadTrabajos(){

			$stmt = Conexion::conectar()->prepare("SELECT nombre, apellido, ifnull(suma_trabajos_realizados(id_mecanico),0)as suma ,ifnull(trabajos_realizados(id_mecanico),0)as nro_trabajos
													FROM mecanico");

			

			$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR MECANICO
	=============================================*/

	static public function mdlEditarMecanico($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ci = :ci, nombre = :nombre, apellido = :apellido ,direccion = :direccion, telefono = :telefono WHERE id_mecanico = :id_mecanico");

		$stmt->bindParam(":id_mecanico", $datos["id_mecanico"], PDO::PARAM_INT);        
        $stmt->bindParam(":ci", $datos["ci"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	ACTUALIZAR MECANICO
	=============================================*/

	static public function mdlActualizarMecanico($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
		/*=============================================
	ELIMINAR MECANICO
	=============================================*/

	static public function mdlEliminarMecanico($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_mecanico = :id_mecanico");

		$stmt -> bindParam(":id_mecanico", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

}
