<?php

require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";

class AjaxServicios{

	/*=============================================
	EDITAR SERVICIO
	=============================================*/	

	public $idServicio;
	public $traerServicios;
	public $nombreServicio;

	public function ajaxEditarServicio(){

		if($this->traerServicios == "ok"){

			$item = null;
			$valor = null;
	  
			$respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);
	
			echo json_encode($respuesta);

		}else if($this->nombreServicio != ""){
			$item = "nombre_servicio";
			$valor = $this->nombreServicio;

			$respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);
	
			echo json_encode($respuesta);
		  }else{
			$item = "id_servicio";
			$valor = $this->idServicio;
	
			$respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);
	
			echo json_encode($respuesta);
	

		  }

	}

}

/*=============================================
EDITAR SERVICIO
=============================================*/	

if(isset($_POST["idServicio"])){

	$servicio = new AjaxServicios();
	$servicio -> idServicio = $_POST["idServicio"];
	$servicio -> ajaxEditarServicio();
}

/*=============================================
TRAER SERVICIO
=============================================*/	

if(isset($_POST["traerServicios"])){

	$traerServicios = new AjaxServicios();
	$traerServicios -> traerServicios = $_POST["traerServicios"];
	$traerServicios -> ajaxEditarServicio();
}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombreServicio"])){

	$traerServicios = new AjaxServicios();
	$traerServicios -> nombreServicio = $_POST["nombreServicio"];
	$traerServicios -> ajaxEditarServicio();
  
  }
  