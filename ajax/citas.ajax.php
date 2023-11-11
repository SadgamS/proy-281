<?php

require_once "../controladores/citas.controlador.php";
require_once "../modelos/citas.modelo.php";

class AjaxCitas{

	/*=============================================
	EDITAR CITA
	=============================================*/	

	public $idCita;

	public function ajaxEditarCIta(){

		$item = "id_cita";
		$valor = $this->idCita;

		$respuesta = ControladorCitas::ctrMostrarCitas($item, $valor);

		echo json_encode($respuesta);


    }


}
/*=============================================
EDITAR CITA
=============================================*/	

if(isset($_POST["idCita"])){

	$cita = new AjaxCitas();
	$cita -> idCita = $_POST["idCita"];
	$cita -> ajaxEditarCIta();

}