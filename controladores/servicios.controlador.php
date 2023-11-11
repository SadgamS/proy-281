<?php

class ControladorServicios{

	/*=============================================
	CREAR SERVICIOS
	=============================================*/

	static public function ctrCrearServicio(){

		if(isset($_POST["nuevoServicio"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoServicio"]) &&
                preg_match('/^[0-9.]+$/', $_POST["nuevoCosto"])){

				$tabla = "servicios";

                $datos = array("servicio"=>$_POST["nuevoServicio"],
                                "costo"=>$_POST["nuevoCosto"]);

				$respuesta = ModeloServicios::mdlIngresarServicios($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El servicio ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "servicios";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El servicio no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "servicios";

							}
						})

			  	</script>';

			}

		}

	}
	/*=============================================
	MOSTRAR SERVICIOS
	=============================================*/

	static public function ctrMostrarServicios($item, $valor){

		$tabla = "servicios";

		$respuesta = ModeloServicios::mdlMostrarServicios($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrMostrarServiciosSol(){


		$respuesta = ModeloServicios::mdlMostrarServiciosSol();

		return $respuesta;

	}

		/*=============================================
	EDITAR SERVICIOS
	=============================================*/

	static public function ctrEditarServicio(){

		if(isset($_POST["editarServicio"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarServicio"]) &&
			   preg_match('/^[0-9.]+$/',$_POST["editarCosto"])){

			   	$tabla = "servicios";

			   	$datos = array("id_servicio"=>$_POST["idServicio"],
			   				   "nombre_servicio"=>$_POST["editarServicio"],
					           "costo"=>$_POST["editarCosto"]);

			   	$respuesta = ModeloServicios::mdlEditarServicio($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El servicio ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "servicios";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El servicio no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "servicios";

							}
						})

			  	</script>';



			}

		}

	}

		/*=============================================
	ELIMINAR SERVICIO
	=============================================*/

	static public function ctrEliminarServicio(){

		if(isset($_GET["idServicio"])){

			$tabla ="servicios";
			$datos = $_GET["idServicio"];

			$respuesta = ModeloServicios::mdlEliminarServicio($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El servicio ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "servicios";

								}
							})

				</script>';

			}		

		}

	}


}
