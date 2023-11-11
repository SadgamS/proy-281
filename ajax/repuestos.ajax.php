<?php

require_once "../controladores/repuestos.controlador.php";
require_once "../modelos/repuestos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxProductos{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idCategoria;

  public function ajaxCrearCodigoProducto(){

    $item = "id_categoria";
    $valor = $this->idCategoria;

    $respuesta = ControladorRepuestos::ctrMostrarRepuestos($item, $valor);

    echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idProducto;
  public $traerProductos;
  public $nombreProducto;


  public function ajaxEditarProducto(){

    if($this->traerProductos == "ok"){

      $item = null;
      $valor = null;

      $respuesta = ControladorRepuestos::ctrMostrarRepuestos($item, $valor);

      echo json_encode($respuesta);


    }else if($this->nombreProducto != ""){

      $item = "tipo_repuesto";
      $valor = $this->nombreProducto;

      $respuesta = ControladorRepuestos::ctrMostrarRepuestos($item, $valor);

      echo json_encode($respuesta);

    }else{

    $item = "id_repuesto";
    $valor = $this->idProducto;

    $respuesta = ControladorRepuestos::ctrMostrarRepuestos($item, $valor);

    echo json_encode($respuesta);

    }
  }

}


/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/ 

if(isset($_POST["idCategoria"])){

  $codigoProducto = new AjaxProductos();
  $codigoProducto -> idCategoria = $_POST["idCategoria"];
  $codigoProducto -> ajaxCrearCodigoProducto();

}
/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idProducto"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> idProducto = $_POST["idProducto"];
  $editarProducto -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerProductos"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> traerProductos = $_POST["traerProductos"];
  $traerProductos -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombreProducto"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> nombreProducto = $_POST["nombreProducto"];
  $traerProductos -> ajaxEditarProducto();

}





