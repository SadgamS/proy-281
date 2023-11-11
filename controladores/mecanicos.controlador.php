<?php

class ControladorMecanicos{

	/*=============================================
	CREAR MECANICOS
	=============================================*/

	static public function ctrCrearMecanico(){

		if(isset($_POST["nuevoNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoId"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellido"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevoDireccion"])){

                   $tabla = "mecanico";
                   date_default_timezone_set('America/La_Paz');

					$fecha = date('Y-m-d');

                   $datos = array("nombre"=>$_POST["nuevoNombre"],
                                "apellido"=>$_POST["nuevoApellido"],
                                "ci"=>$_POST["nuevoDocumentoId"],
                                "direccion"=>$_POST["nuevoDireccion"],
                               "telefono"=>$_POST["nuevoTelefono"],
                               "fecha_ingreso"=>$fecha);

			   	$respuesta = ModeloMecanicos::mdlIngresarMecanico($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El mecanico ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "mecanicos";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El mecanico no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "mecanicos";

							}
						})

			  	</script>';



			}

		}
	}
	
	/*=============================================
	MOSTRAR MECANICOS
	=============================================*/

	static public function ctrMostrarCantidadTrabajos(){


		$respuesta = ModeloMecanicos::mdlMostrarCantidadTrabajos();

		return $respuesta;

	}


	static public function ctrMostrarMecanicos($item, $valor){

		$tabla = "mecanico";

		$respuesta = ModeloMecanicos::mdlMostrarMecanicos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR MEACANICO
	=============================================*/

	static public function ctrEditarMecanico(){

		if(isset($_POST["editarNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellido"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])){

			   	$tabla = "mecanico";

			   	$datos = array("id_mecanico"=>$_POST["idMecanico"],
                               "nombre"=>$_POST["editarNombre"],
					           "ci"=>$_POST["editarDocumentoId"],
					           "apellido"=>$_POST["editarApellido"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"]);

			   	$respuesta = ModeloMecanicos::mdlEditarMecanico($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El mecanico ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "mecanicos";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El mecanico no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "mecanicos";

							}
						})

			  	</script>';



			}

		}

	}
		/*=============================================
	ELIMINAR MECANICO
	=============================================*/

	static public function ctrEliminarMecanico(){

		if(isset($_GET["idMecanico"])){

			$tabla ="mecanico";
			$datos = $_GET["idMecanico"];

			$respuesta = ModeloMecanicos::mdlEliminarMecanico($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El mecanico ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "mecanicos";

								}
							})

				</script>';

			}		

		}

	}

}