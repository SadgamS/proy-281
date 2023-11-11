<?php

require_once "../controladores/mecanicos.controlador.php";
require_once "../modelos/mecanicos.modelo.php";

class AjaxMecanicos{

	/*=============================================
	EDITAR MECANICO
	=============================================*/	

	public $idMecanico;

	public function ajaxEditarMecanico(){

		$item = "id_mecanico";
		$valor = $this->idMecanico;

		$respuesta = ControladorMecanicos::ctrMostrarMecanicos($item, $valor);

		echo json_encode($respuesta);


    }
    /*=============================================
	ACTIVAR MECANICO
	=============================================*/	

	public $activarMecanico;
	public $activarId;


	public function ajaxActivarMecanico(){

		$tabla = "mecanico";

		$item1 = "estado";
		$valor1 = $this->activarMecanico;

		$item2 = "id_mecanico";
		$valor2 = $this->activarId;

		$respuesta = ModeloMecanicos::mdlActualizarMecanico($tabla, $item1, $valor1, $item2, $valor2);

	}


}

/*=============================================
EDITAR MECANICO
=============================================*/	

if(isset($_POST["idMecanico"])){

	$mecanico = new AjaxMecanicos();
	$mecanico -> idMecanico = $_POST["idMecanico"];
	$mecanico -> ajaxEditarMecanico();

}

/*=============================================
ACTIVAR MECANICO
=============================================*/	

if(isset($_POST["activarMecanico"])){

	$activarMecanico = new AjaxMecanicos();
	$activarMecanico -> activarMecanico = $_POST["activarMecanico"];
	$activarMecanico -> activarId = $_POST["activarId"];
	$activarMecanico -> ajaxActivarMecanico();

}
