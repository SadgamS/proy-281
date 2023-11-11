<?php

require_once "conexion.php";

class ModeloVehiculos{
    
	/*=============================================
	MOSTRAR VEHICULO
	=============================================*/

	static public function mdlMostrarVehiculo($tabla, $item, $valor){

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
	REGISTRO DE VEHICULO
	=============================================*/
	static public function mdlIngresarVehiculo($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(placa,marca,modelo,anho,color,kilometraje,id_cliente) VALUES (:placa,:marca,:modelo,:anho,:color,:kilometraje,:id_cliente)");
        
      
		
		$stmt->bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":anho", $datos["anho"], PDO::PARAM_INT);
        $stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":kilometraje", $datos["kilometraje"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
        }
    
		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	EDITAR DE VEHICULO
	=============================================*/
	static public function mdlEditarVehiculo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET placa = :placa,marca = :marca,modelo = :modelo,anho = :anho,color = :color,kilometraje = :kilometraje,id_cliente = :id_cliente WHERE id_vehiculo=:id_vehiculo");
		
        
      
		$stmt->bindParam(":id_vehiculo", $datos["id_vehiculo"], PDO::PARAM_INT);
		$stmt->bindParam(":placa", $datos["placa"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":anho", $datos["anho"], PDO::PARAM_INT);
        $stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":kilometraje", $datos["kilometraje"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
        }
    
		$stmt->close();
		$stmt = null;

    }
	/*=============================================
	ELIMINAR VEHICULO
	=============================================*/

	static public function mdlEliminarVehiculo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_vehiculo = :id_vehiculo");

		$stmt -> bindParam(":id_vehiculo", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	/*=============================================
	ACTUALIZAR VEHICULO
	=============================================*/

	static public function mdlActualizarVehiculo($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_vehiculo= :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


}