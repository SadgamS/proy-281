<?php

class ControladorCitas {
    
	/*=============================================
	CREAR CITA      
	=============================================*/

	static public function ctrCrearCita(){

        if(isset($_POST["nuevoCcliente"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDesc"])){

                $tabla = "citas";


                $datos = array("id_cliente"=>$_POST["nuevoCcliente"],
                                "fecha"=>$_POST["nuevoFechaH"],
                                "descripcion"=>$_POST["nuevoDesc"]);
                
                $respuesta = ModeloCitas::mdlIngresarCita($tabla, $datos);

                if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La cita ha sido creado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "citas";

									}
								})

					</script>';

				}else{

                    echo'<script>
    
                        swal({
                              type: "error",
                              title: "¡La cita no puede ir vacío o llevar caracteres especiales!",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                if (result.value) {
    
                                window.location = "citas";
    
                                }
                            })
    
                      </script>';
    
                    }
    
            }
        
        }

    }
    	/*=============================================
	MOSTRAR CITAS
	=============================================*/


    static public function ctrMostrarCitas($item, $valor){

		$tabla = "citas";

		$respuesta = ModeloCitas::mdlMostrarCitas($tabla, $item, $valor);

		return $respuesta;

    }
    
    /*=============================================
	EDITAR CITA
	=============================================*/

	static public function ctrEditarCita(){

		if(isset($_POST["editarCcliente"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDesc"])){

			   	$tabla = "citas";

                   $datos = array("id_cita"=>$_POST["idCita"],
                                    "id_cliente"=>$_POST["editarCcliente"],
                                    "fecha"=>$_POST["editarFechaH"],
                                    "descripcion"=>$_POST["editarDesc"]);

			   	$respuesta = ModeloCitas::mdlEditarCita($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La cita ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "admcitas";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La cita no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "admcitas";

							}
						})

			  	</script>';



			}

		}

    }
    
    
    /*=============================================
	ELIMINAR CITA
	=============================================*/

	static public function ctrEliminarCita(){

		if(isset($_GET["idCita"])){

			$tabla ="citas";
			$datos = $_GET["idCita"];

			$respuesta = ModeloCitas::mdlEliminarCita($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La cita ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "admcitas";

								}
							})

				</script>';

			}		

		}

	}


}
