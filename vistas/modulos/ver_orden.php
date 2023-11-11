<?php

if($_SESSION["perfil"] == "Mecanico" || $_SESSION["perfil"] == "Encargado"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Ver orden de trabajo
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Ver orden de trabajo</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-8 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"><h3 class="box-title">Datos del orden de trabajo</h3></div>

          <form role="form" method="post" class="formularioTrabajo">

            <div class="box-body">
  
              <div class="box">

              <?php
                    $item = "id_orden";
                    $valor = $_GET["idOrden"];

                    $orden= ControladorOrdenTrabajo::ctrMostrarOrden($item,$valor);


                    $itemC = "id_cliente";
                    $valorC = $orden["id_cliente"]; 

                    $clientes = ControladorClientes::ctrMostrarClientes($itemC, $valorC);

                    $itemV = "id_vehiculo";
                    $valorV = $orden["id_vehiculo"]; 

                    $vehiculo= ControladorVehiculos::ctrMostrarVehiculos($itemV, $valorV);


                    
                    $itemM = "id_mecanico";
                    $valorM = $orden["id_mecanico"];

                    $mecanicos = ControladorMecanicos::ctrMostrarMecanicos($itemM, $valorM);

                    $porcentajeImpuesto = $orden["impuesto"] * 100 / $orden["neto"];




               ?>

                <!--=====================================
                ENTRADA DEL NRO DE ORDEN
                ======================================--> 

                <div class="form-group">
                <label class="col-sm-3 control-label">Nro. de orden:</label>
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                        <input type="text" class="form-control" id="nuevaOrden" name="nuevaOrden" value="<?php echo $orden["nro_orden"]   ?>" readonly>
           
                  </div>
                
                </div>

                  <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <div class="input-group-addon"><i class="fa fa-users"></i></div>
                    
                    <input type="text" class="form-control" id="seleccionarCliente" name="seleccionarCliente"  value="<?php echo $clientes["nombre"] ?>" readonly>

                  </div>
                
                </div>

           

                <!--=====================================
                ENTRADA DEL VEHICULO
                ======================================--> 

                <div class="form-group">
                <label class="col-sm-3 control-label">Selccionar vehiculo:</label>
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-car"></i></span>
                    
                    <input type="text" class="form-control" id="seleccionarVehiculo" name="seleccionarVehiculo" value="<?php echo $vehiculo["marca"].'   '.$vehiculo["modelo"].'   '.$vehiculo["placa"] ?>"  readonly>
                

                  </div>
                
                </div>


                <!--=====================================
                ENTRADA DEL MECANICO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    
                    <input type="text"  class="form-control" id="seleccionarMecanico" name="seleccionarMecanico" value="<?php echo $mecanicos["nombre"].'   '.$mecanicos["apellido"] ?>"  readonly >

                  </div>
                
                </div>

                 <!--=====================================
                ENTRADA DEL SERVICIO
                ======================================--> 

                <div class="form-group">
                
                
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                  <label class="col-sm-4 control-label">Servicios solicitados:</label>

                  </div>
                
                </div>
                
                <!--=====================================
                ENTRADA PARA AGREGAR SERVICIO
                ======================================--> 
                <div class="form-group row nuevoServicio">

                <?php

                    $listaServicios= ModeloOrdenTrabajo::mdlMostrarOrdenServicios( $orden["id_orden"]);
                        
                    foreach ($listaServicios as $key => $value) {
                        
                    echo '<div class="row" style="padding:5px 15px">
  
                    <!-- Servicio -->   
                    
                    <div class="col-xs-6" style="padding-right:0px">
                    
                      <div class="input-group">
                        
                        <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarServicio" idServicio><i class="fa fa-times"></i></button></span>
      
                        <input type="text" class="form-control nuevoNServicio"   idServicio name="nuevoServicio"  value="'.$value["nombre_servicio"].'"   readonly>
      
                      </div>
      
                    </div>
      
      
                    <!-- Precio del servicio -->
      
                    <div class="col-xs-3 ingresoPrecioS">
      
                      <div class="input-group ">
      
                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                           
                        <input type="text" class="form-control nuevoPrecioServicio" precioReal="" name="nuevoPrecioServicio" value="'.$value["costo"].'" readonly >
           
                      </div>
                       
                    </div>
      
                    </div>';
                    
                    
                    
                    }


                ?>

                

                </div>
                <input type="hidden" id="listaServicios" name="listaServicios">

                <hr>  
                <div class="form-group">
                
                
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                <label class="col-sm-4 control-label">Repuestos usados:</label>

                </div>
              
              </div>
                <!--=====================================
                ENTRADA PARA AGREGAR REPUESTO
                ======================================--> 
                <div class="form-group row nuevoProducto">
                    <?php
                        $listaRepuestos=ModeloOrdenTrabajo::mdlMostrarOrdenRepuestos( $orden["id_orden"]);

                        foreach ($listaRepuestos as $key => $value) {
       
                        echo 	'<div class="row" style="padding:5px 15px">

                        <!-- Descripción del producto -->
                        
                        <div class="col-xs-6" style="padding-right:0px">
                        
                          <div class="input-group">
                            
                            <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" ><i class="fa fa-times"></i></button></span>
          
                            <input type="text" class="form-control nuevaDescripcionProducto"  name="agregarProducto" value="'.$value["tipo_repuesto"].'" readonly required>
          
                          </div>
          
                        </div>
          
                        <!-- Cantidad del producto -->
          
                        <div class="col-xs-3">
                          
                           <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto"  value="'.$value["cantidad"].'"  readonly>
          
                        </div>
          
                        <!-- Precio del producto -->
          
                        <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">
          
                          <div class="input-group">
          
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                               
                            <input type="text" class="form-control nuevoPrecioProducto np"  name="nuevoPrecioProducto" value="'.$value["precio"].'" readonly required>
               
                          </div>
                           
                        </div>
          
                      </div>';
                    }

                    
                    
                    ?>

                

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

              
                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?php echo $porcentajeImpuesto ?>" readonly>
                            
                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" value="<?php echo $orden["neto"] ?>" readonly r>
                              <input type="hidden" name="totalVenta" id="totalVenta">
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

              


              </div>

          </div>

          <div class="box-footer">

            <a href="admordentra"><button type="button" class="btn btn-danger pull-right">Salir</button></a>

          </div>

        </form>

        </div>
            
      </div>

   
   
  </section>

</div>

