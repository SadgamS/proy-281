<?php

require_once "conexion.php";

class ModeloOrdenTrabajo{

	/*=============================================
	MOSTRAR ORDENES DE TRABAJO
	=============================================*/

	static public function mdlMostrarOrden($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_orden ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_orden ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}
	/*=============================================
	MOSTRAR LOS SERVICIOS DEL ORDEN DE TRABAJO
	=============================================*/
	static public function mdlMostrarOrdenServicios( $valor){

		$stmt = Conexion::conectar()->prepare("SELECT s.id_servicio, s.nombre_servicio, s.costo FROM servicios_orden_trabajo se, servicios s WHERE se.id_servicio=s.id_servicio AND se.id_orden=:id_orden" );
		$stmt -> bindParam(":id_orden", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();
	}

	/*=============================================
	MOSTRAR LOS REPUESTOS DEL ORDEN DE TRABAJO
	=============================================*/
	static public function mdlMostrarOrdenRepuestos( $valor){

		$stmt = Conexion::conectar()->prepare("SELECT r.id_repuesto, r.tipo_repuesto,re.precio,re.cantidad,r.stock,re.total FROM repuestos_orden_trabajo re, repuesto r WHERE re.id_repuesto = r.id_repuesto AND re.id_orden=:id_orden " );
		$stmt -> bindParam(":id_orden", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();
	}
	
	
	/*=============================================
	REGISTRO DE ORDEN DE TRABAJO
	=============================================*/

	static public function mdlIngresarOrden($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nro_orden, fecha, total, impuesto, neto, id_mecanico, id_vehiculo,id_cliente ) VALUES (:nro_orden, :fecha, :total, :impuesto, :neto, :id_mecanico, :id_vehiculo, :id_cliente)");

		$stmt->bindParam(":nro_orden", $datos["nro_orden"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vehiculo", $datos["id_vehiculo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_mecanico", $datos["id_mecanico"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		//$stmt->bindParam(":servicios", $datos["servicios"], PDO::PARAM_STR);
		//$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		if($stmt->execute()){

			$traerOrden= ModeloOrdenTrabajo::mdlMostrarOrden("orden_trabajo", null, null);

			foreach ($traerOrden as $key => $value) {
	
			}

		   	$id_orden= $value["id_orden"];
			
			$listaServicios= json_decode($datos["servicios"], true);

		  
			$stmt2 = Conexion::conectar()->prepare("INSERT INTO servicios_orden_trabajo VALUES ($id_orden, :id_servicio)");
            foreach ($listaServicios as $key => $value) {
				
				$stmt2->bindParam(":id_servicio", $value["id_servicio"], PDO::PARAM_INT);

				$stmt2->execute();
			}
		
			$listaRepuestos= json_decode($datos["productos"], true);

			$stmt3 = Conexion::conectar()->prepare("INSERT INTO repuestos_orden_trabajo VALUES ($id_orden, :id_repuesto, :precio, :cantidad, :total)");
            foreach ($listaRepuestos as $key => $value) {
				
				$stmt3->bindParam(":id_repuesto", $value["id_repuesto"], PDO::PARAM_INT);
				$stmt3->bindParam(":precio", $value["precio"], PDO::PARAM_INT);
				$stmt3->bindParam(":cantidad", $value["cantidad"], PDO::PARAM_INT);
				$stmt3->bindParam(":total", $value["total"], PDO::PARAM_INT);
				$stmt3->execute();
			}

		
			

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
		$stmt2->close();
		$stmt2 = null;
		$stmt3->close();
		$stmt3 = null;

	}

		/*=============================================
	ELIMINAR ORDEN
	=============================================*/

	static public function mdlEliminarOrden($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_orden = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			$stmt2 = Conexion::conectar()->prepare("DELETE FROM servicios_orden_trabajo where id_orden= :id");
			$stmt2 -> bindParam(":id", $datos, PDO::PARAM_INT);
			$stmt2->execute();

			$stmt3 = Conexion::conectar()->prepare("DELETE FROM repuestos_orden_trabajo WHERE id_orden= :id");
			$stmt3 -> bindParam(":id", $datos, PDO::PARAM_INT);
			$stmt3->execute();
			return "ok";

		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

		/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasOrden($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_orden ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	
	}


		/*=============================================
	SUMAR EL TOTAL DE TRABAJOS
	=============================================*/

	static public function mdlSumaTotalTrabajos($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

}