<?php

require_once "../controladores/repuestos.controlador.php";
require_once "../modelos/repuestos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaRepuestos(){

		$item = null;
    	$valor = null;

        $productos = ControladorRepuestos::ctrMostrarRepuestos($item, $valor);
      
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

	        /*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 

		  	$item = "id_categoria";
              $valor = $productos[$i]["id_categoria"];
              
              $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
            
            
            /*=============================================
 	 		STOCK
  			=============================================*/ 

  			if($productos[$i]["stock"] <= 10){

                $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";

            }else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15){

                $stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";

            }else{

                $stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";

            }

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
              =============================================*/ 
			  if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Encargado" || isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Mecanico"){ 
			  $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id_repuesto"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button></div>"; 
			  }
			  else{
			  $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id_repuesto"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id_repuesto"]."'  imagen='".$productos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>"; 
			  }  
			  $datosJson .='[
				  "'.($i+1).'",
				  "'.$productos[$i]["codigo"].'",
			      "'.$productos[$i]["tipo_repuesto"].'",
			      "'.$productos[$i]["marca"].'",
                  "'.$stock.'",
			      "'.$productos[$i]["precio_compra"].'",
                  "'.$productos[$i]["precio_venta"].'",
                  "'.$categorias["categoria"].'",
                  "'.$imagen.'",
                  "'.$productos[$i]["observacion"].'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaRepuestos();

