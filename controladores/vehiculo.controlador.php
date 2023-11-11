<?php

class ControladorVehiculos{
    	/*=============================================
	MOSTRAR VEHICULO
	=============================================*/

	static public function ctrMostrarVehiculos($item, $valor){

		$tabla = "vehiculo";

		$respuesta = ModeloVehiculos::mdlMostrarVehiculo($tabla, $item, $valor);

		return $respuesta;

    }
    	/*=============================================
	CREAR VEHICULO
	=============================================*/

	static public function ctrCrearVehiculo(){

		if(isset($_POST["nuevaPlaca"])){

			if(preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaPlaca"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarca"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoModelo"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoAnho"]) &&	
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoColor"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoKilometraje"])){

		
				$tabla = "vehiculo";

				$datos = array("placa" => $_POST["nuevaPlaca"],
							   "marca" => $_POST["nuevaMarca"],
							   "modelo" => $_POST["nuevoModelo"],
							   "anho" => $_POST["nuevoAnho"],
							   "color" => $_POST["nuevoColor"],
							   "kilometraje" => $_POST["nuevoKilometraje"],
                               "id_cliente" => $_POST["nuevoPropietario"]);
                               

				$respuesta = ModeloVehiculos::mdlIngresarVehiculo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El vehiculo ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "vehiculos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El vehiculo no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "vehiculos";

							}
						})

			  	</script>';
			}
		}

	}
	
		/*=============================================
	EDITAR VEHICULO
	=============================================*/

	static public function ctrEditarVehiculo(){

		if(isset($_POST["editarPlaca"])){

			if(preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarPlaca"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarModelo"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarAnho"]) &&	
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarColor"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarKilometraje"])){

		
				$tabla = "vehiculo";

				$datos = array("id_vehiculo" => $_POST["idVehiculo"],
							   "placa" => $_POST["editarPlaca"],
							   "marca" => $_POST["editarMarca"],
							   "modelo" => $_POST["editarModelo"],
							   "anho" => $_POST["editarAnho"],
							   "color" => $_POST["editarColor"],
							   "kilometraje" => $_POST["editarKilometraje"],
                               "id_cliente" => $_POST["editarPropietario"]);
                               

				$respuesta = ModeloVehiculos::mdlEditarVehiculo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El vehiculo ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "vehiculos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El vehiculo no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "vehiculos";

							}
						})

			  	</script>';
			}
		}

	}
		/*=============================================
	ELIMINAR VEHICULO
	=============================================*/

	static public function ctrEliminarVehiculo(){

		if(isset($_GET["idVehiculo"])){

			$tabla ="vehiculo";
			$datos = $_GET["idVehiculo"];

			$respuesta = ModeloVehiculos::mdlEliminarVehiculo($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El vehiculo ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "vehiculos";

								}
							})

				</script>';

			}		

		}

	}


}