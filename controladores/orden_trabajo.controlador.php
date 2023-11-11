<?php
class ControladorOrdenTrabajo{

    /*=============================================
	MOSTRAR ORDENES DE TRABAJOS
	=============================================*/

	static public function ctrMostrarOrden($item, $valor){

		$tabla = "orden_trabajo";

		$respuesta = ModeloOrdenTrabajo::mdlMostrarOrden($tabla, $item, $valor);

		return $respuesta;

	}

	

	static public function ctrMostrarOrdenCliente($valor){


		$respuesta = ModeloOrdenTrabajo::mdlMostrarOrdenCliente($valor);

		return $respuesta;

	}
	/*=============================================
	CREAR ORDEN DE TRABAJO
    =============================================*/
    
    static public function ctrCrearOrden(){
       
        if(isset($_POST["nuevaOrden"])){
        
			$listaRepuestos= json_decode($_POST["listaProductos"], true);

			
			
			$listaServicios= json_decode($_POST["listaServicios"], true);
			

			 foreach ($listaRepuestos as $key => $value) {
				
			 	$tablaRepuestos = "repuesto";

				$item = "id_repuesto";
				$valor = $value["id_repuesto"];
				
				$traerRepuesto= ModeloRepuestos::mdlMostrarRepuestos($tablaRepuestos,$item,$valor);
				
				$item1a = "ventas";
				$valor1a = $value["cantidad"]+$traerRepuesto["ventas"];

			   	$nuevoStock = ModeloRepuestos::mdlActualizarRepuesto($tablaRepuestos, $item1a, $valor1a, $valor);
				
				
			   	$item1b = "stock";
			 	$valor1b = $value["stock"];

				$nuevoStock = ModeloRepuestos::mdlActualizarRepuesto($tablaRepuestos, $item1b, $valor1b, $valor);


			 }
			
			$tablaClientes = "clientes";
			$item1b = "ultimo_arreglo";
			$valorc = $_POST["seleccionarCliente"];

			date_default_timezone_set('America/La_Paz');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

			$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			$tablaVehiculos = "vehiculo";

			$item = "id_vehiculo";
			$valor = $_POST["seleccionarVehiculo"];

			$traerVehiculo = ModeloVehiculos::mdlMostrarVehiculo($tablaVehiculos, $item, $valor);


			$item1a = "nro_arreglos";

			$valor1a = $traerVehiculo["nro_arreglos"]+1;

			$arreglosVehiculo = ModeloVehiculos::mdlActualizarVehiculo($tablaVehiculos,$item1a, $valor1a, $valor);

			$tablaMecanico = "mecanico";

			$item1 = "estado";
			$valor1 = "0";

			$item2 = "id_mecanico";
			$valor2 = $_POST["seleccionarMecanico"];

			$actMecani = ModeloMecanicos::mdlActualizarMecanico($tablaMecanico, $item1, $valor1, $item2, $valor2);

			/*=============================================
			GUARDAR ORDEN DE TRABAJO
			=============================================*/	

			$tabla = "orden_trabajo";

			date_default_timezone_set('America/La_Paz');

		    $fecha1 = date('Y-m-d');
			$hora = date('H:i:s');

			$fecha = $fecha1.' '.$hora;
			$datos = array("nro_orden"=>$_POST["nuevaOrden"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "id_vehiculo"=>$_POST["seleccionarVehiculo"],
						   "id_mecanico"=>$_POST["seleccionarMecanico"],
						   "servicios"=>$_POST["listaServicios"],
						   "productos"=>$_POST["listaProductos"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"],
						   "fecha"=>$fecha);


			 $respuesta = ModeloOrdenTrabajo::mdlIngresarOrden($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "El orden de trabajo ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "admordentra";

								}
							})

				</script>';

			}
        }
    
    
	}
	
	/*=============================================
	ELIMINAR ORDEN
	=============================================*/

	static public function ctrEliminarOrden(){
		if(isset($_GET["idOrden"])){

			$tabla = "orden_trabajo";

			$item = "id_orden";
			$valor = $_GET["idOrden"];

			$traerOrden = ModeloOrdenTrabajo::mdlMostrarOrden($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA
			=============================================*/

			$tablaClientes = "clientes";

			$itemOrden= null;
			$valorOrden= null;

			$traerOrdens= ModeloOrdenTrabajo::mdlMostrarOrden($tabla, $itemOrden, $valorOrden);

			$guardarFechas = array();

			foreach ($traerOrdens as $key => $value) {
				
				if($value["id_cliente"] == $traerOrden["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}
			if(count($guardarFechas) > 1){

				if($traerOrden["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultimo_arreglo";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerOrden["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultimo_arreglo";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerOrden["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}

			}
			else{

				$item = "ultimo_arreglo";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerOrden["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);
			}
			
			/*=============================================
			FORMATEAR TABLA DE REPUESTOS Y LA DE CLIENTES
			=============================================*/

			$repuestos=ModeloOrdenTrabajo::mdlMostrarOrdenRepuestos( $_GET["idOrden"]);

			foreach ($repuestos as $key => $value) {

				$tablaRepuestos = "repuesto";

				$item = "id_repuesto";
				$valor = $value["id_repuesto"];
				

				$traerRepuesto= ModeloRepuestos::mdlMostrarRepuestos($tablaRepuestos, $item, $valor);

				
				$item1b = "stock";
				$valor1b =$value["cantidad"] +  $traerRepuesto["stock"];

			   $nuevoStock = ModeloRepuestos::mdlActualizarRepuesto($tablaRepuestos, $item1b, $valor1b, $valor);


			}

			
			$tablaVehiculos = "vehiculo";

			$item = "id_vehiculo";
			$valor = $traerOrden["id_vehiculo"];

			$traerVehiculo = ModeloVehiculos::mdlMostrarVehiculo($tablaVehiculos, $item, $valor);


			$item1a = "nro_arreglos";

			$valor1a = $traerVehiculo["nro_arreglos"]-1;

			$arreglosVehiculo = ModeloVehiculos::mdlActualizarVehiculo($tablaVehiculos,$item1a, $valor1a, $valor);

			$tablaMecanico = "mecanico";

			$item1 = "estado";
			$valor1 = "1";

			$item2 = "id_mecanico";
			$valor2 =$traerOrden["id_mecanico"];

			$actMecani = ModeloMecanicos::mdlActualizarMecanico($tablaMecanico, $item1, $valor1, $item2, $valor2);

			/*=============================================
			ELIMINAR ORDEN
			=============================================*/

			$respuesta = ModeloOrdenTrabajo::mdlEliminarOrden($tabla, $_GET["idOrden"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El orden de trabajo ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "admordentra";

								}
							})

				</script>';

			}	
		}


	}
		/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasOrden($fechaInicial, $fechaFinal){

		$tabla = "orden_trabajo";

		$respuesta = ModeloOrdenTrabajo::mdlRangoFechasOrden($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "orden_trabajo";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$orden = ModeloOrdenTrabajo::mdlRangoFechasOrden($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$orden = ModeloOrdenTrabajo::mdlMostrarOrden($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>NRO ORDEN</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>MECANICO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>SERVICIOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($orden as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("id_cliente", $item["id_cliente"]);
				$mecanico = ControladorMecanicos::ctrMostrarMecanicos("id_mecanico", $item["id_mecanico"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["nro_orden"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$mecanico["nombre"]." ".$mecanico["apellido"]."</td>
			 			<td style='border:1px solid #eee;'>");
			 $repuestos =  ModeloOrdenTrabajo::mdlMostrarOrdenRepuestos($item["id_orden"]);

			 foreach ($repuestos as $key => $valueRepuestos) {
								 
					 echo utf8_decode($valueRepuestos["cantidad"]."<br>");
				 }
		
			 echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
		
			foreach ($repuestos as $key => $valueRepuestos) {
								 
					 echo utf8_decode($valueRepuestos["tipo_repuesto"]."<br>");
						 
					 }
		
				 echo utf8_decode("</td>");
				 $servicios = ModeloOrdenTrabajo::mdlMostrarOrdenServicios($item["id_orden"]);
				 

			 	echo utf8_decode("<td style='border:1px solid #eee;'>");	

		 		foreach ($servicios as $key => $valueServicio) {
			 			
		 			echo utf8_decode($valueServicio["nombre_servicio"]."<br>");
		 		
		 		}

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>Bs. ".number_format($item["impuesto"],2)."</td>
					<td style='border:1px solid #eee;'>Bs. ".number_format($item["neto"],2)."</td>	
					<td style='border:1px solid #eee;'>Bs. ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
		 			</tr>");


			}


			echo "</table>";

		}

	}

	/*=============================================
	SUMA TOTAL TRABAJOS
	=============================================*/

	static public function ctrSumaTotalTrabajos(){

		$tabla = "orden_trabajo";

		$respuesta = ModeloOrdenTrabajo::mdlSumaTotalTrabajos($tabla);

		return $respuesta;

	}

}