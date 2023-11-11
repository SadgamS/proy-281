<aside class="main-sidebar">

    <section class="sidebar">
    <div class="user-panel">
     
      </div>
        
        <ul class="sidebar-menu">

        <li class="header">PANEL ADMINISTRADOR</li>
        <?php

    if($_SESSION["perfil"] == "Administrador"){
      echo  '<li  data-widget="tree">
            <a href="inicio">
                <i class="fa fa-home"></i>
                <span>Inicio</span>
            </a>

        </li>
        <li>
            <a href="usuarios">
                <i class="fa fa-user"></i>
                <span>Usuarios</span>
            </a>

        </li>';
  }

  if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Encargado" || $_SESSION["perfil"] == "Mecanico"){

      echo '<li class="treeview">
            <a href="#">
                <i class="fa fa-th"></i>
                <span>Inventario</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">';
            if($_SESSION["perfil"]=="Administrador" || $_SESSION["perfil"] == "Encargado"){
             echo '<li><a href="categorias"><i class="glyphicon glyphicon-th-list"></i> Categorias</a></li>';
            }
            echo '<li><a href="repuestos"><i class="fa fa-wrench"></i> Repuestos</a></li>
          </ul>

        </li>';
  }

  if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Encargado" || $_SESSION["perfil"] == "Mecanico"){
       echo '<li class="active treeview">
            <a href="#">
                <i class="fa fa-gears"></i>
                <span>Trabajos</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            <li class="active"> <a href="ordentrabajo"><i class="fa fa-gear"></i><span>Crear orden de trabajo</span></a></li>
            <li > <a href="admordentra"><i class="fa  fa-file-text-o"></i><span>Administrar orden de trabajo</span></a></li>';
            if($_SESSION["perfil"] == "Administrador"){
             echo '<li> <a href="reportes"><i class="fa fa-line-chart"></i><span>Reporte de orden de trabajo</span></a></li>';
            }
             echo '</ul>
        </li>';
  }
  if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Encargado"){     
       echo '<li>
            <a href="clientes">
                <i class="fa fa-users"></i>
                <span>Clientes</span>
            </a>
        </li>
        <li>
            <a href="vehiculos">
                <i class="fa fa-car"></i>
                <span>Vehiculos</span>
            </a>
        </li>';
  }
  if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Encargado"){ 
        echo '<li> 
            <a href="servicios">
                <i class="glyphicon glyphicon-briefcase"></i>
                <span>Servicios</span>
            </a>
        </li>';
  }
  if($_SESSION["perfil"] == "Administrador"){ 
      echo '<li>
            <a href="mecanicos">
                <i class="fa fa-users"></i>
                <span>Mecanicos</span>
            </a>
        </li>';
  }
  if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Encargado"){ 
    echo '<li class="treeview">
        <a href="#">
            <i class="fa fa-calendar"></i>
            <span>Citas</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
         <ul class="treeview-menu">
           <li> <a href="citas">
              <i class="fa fa-calendar-plus-o"></i>
              <span>Crear Citas</span>
            </a>
          </li>
          <li>
          <a href="admcitas">
          <i class="fa fa-calendar-plus-o"></i>
          <span>Administrar Citas</span>
         </a>
         </li>
      </ul>
      </li>';
}
?>
  ?>
  

        </ul>


    </section>


</aside>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear orden de trabajo
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear orden de trabajo</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"><h3 class="box-title">Datos del orden de trabajo</h3></div>

          <form role="form" method="post" class="formularioTrabajo">

            <div class="box-body">
  
              <div class="box">

                   <!--=====================================
                ENTRADA DEL NRO DE ORDEN
                ======================================--> 

                <div class="form-group">
                <label class="col-sm-3 control-label">Nro. de orden:</label>
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php
                      $item = null;
                      $valor = null;
  
                      $orden = ControladorOrdenTrabajo::ctrMostrarOrden($item, $valor);

                      if (!$orden) {

                        echo '<input type="text" class="form-control" id="nuevaOrden" name="nuevaOrden" value="10001" readonly>';
                      
                      }else{

                        foreach ($orden as $key => $value) {
                        
                        
                      
                        }
  
                        $codigo = $value["nro_orden"] + 1;

                        echo '<input type="text" class="form-control" id="nuevaOrden" name="nuevaOrden" value="'.$codigo.'" readonly>';
                

                      }
                    
                   
                    
                    ?>

                  </div>
                
                </div>

                  <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <div class="input-group-addon"><i class="fa fa-users"></i></div>
                    
                    <select class="form-control select2" id="seleccionarCliente" name="seleccionarCliente" required style="height:0px;">

                    <option value="0">Seleccionar cliente</option>
                    <?php

                      $item = null;
                      $valor = null; 

                      $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                      foreach ($clientes as $key => $value) {

                        echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].'</option>';
                        $idCliente=$value["id_cliente"];
                      }

                    ?>

                    </select>
                    
                    <div class="input-group-addon"><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></div>
                    
                  
                  </div>
                
                </div>

           

                <!--=====================================
                ENTRADA DEL VEHICULO
                ======================================--> 

                <div class="form-group">
                <label class="col-sm-3 control-label">Selccionar vehiculo:</label>
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-car"></i></span>
                    
                    <select class="form-control select2" id="seleccionarVehiculo" name="seleccionarVehiculo" required>
                
          
                    </select>

                    <span class="input-group-addon"><button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalAgregarVehiculo" data-dismiss="modal">Agregar vehiculo</button></span>
                  
                  </div>
                
                </div>


                <!--=====================================
                ENTRADA DEL MECANICO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    
                    <select class="form-control select2" id="seleccionarMecanico" name="seleccionarMecanico" required >

                    <option value="">Seleccionar mecanico</option>
                    <?php
                       

                       $item = null;
                       $valor = null;

                       $mecanicos = ControladorMecanicos::ctrMostrarMecanicos($item, $valor);

                       
                       foreach ($mecanicos as $key => $value) {

                        if ($value["estado"]!=0) {
                          echo '<option value="'.$value["id_mecanico"].'">'.$value["nombre"].' '.$value["apellido"].'</option>';
                        }
                       }

                     ?>

                    

                    </select>
                    
                   
                    
                  
                  </div>
                
                </div>

                 <!--=====================================
                ENTRADA DEL SERVICIO
                ======================================--> 

                <div class="form-group">
                
                
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                  <label class="col-sm-4 control-label">Seleccionar el servicio:</label>
                  <button type="button" class="btn btn-info btnAgregarServicio">Agregar un nuevo servicio</button>

                  </div>
                
                </div>
                
                <!--=====================================
                ENTRADA PARA AGREGAR SERVICIO
                ======================================--> 
                <div class="form-group row nuevoServicio">

                

                </div>
                <input type="hidden" id="listaServicios" name="listaServicios">

                <hr>  

                <!--=====================================
                ENTRADA PARA AGREGAR REPUESTO
                ======================================--> 
                <div class="form-group row nuevoProducto">

                

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

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
                           
                              
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>
                              <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                              <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="00000" readonly required>
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

            <button type="submit" class="btn btn-primary pull-right">Guardar orden</button>

          </div>

        </form>
        <?php

          $guardarOrden = new ControladorOrdenTrabajo();
          $guardarOrden -> ctrCrearOrden();

          ?>
        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

        <div class="box-header with-border"><h3 class="box-title">Lista de repuestos</h3></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaTrabajos" width="100%">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Código</th>
                  <th>Tipo de repuesto</th>
                  <th>Marca</th>
                  <th>Imagen</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar ci" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'999-99999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>
            <?php

            $crearCliente = new ControladorClientes();
            $crearCliente -> ctrCrearCliente();

            ?>
    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR VEHICULO
======================================-->

<div id="modalAgregarVehiculo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Vehiculo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR EL PROPIETARIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select class="form-control input-lg" id="nuevoPropietario"  name="nuevoPropietario" required>
                
                <option value="">Selecionar propietario</option>
                <?php

                    $item = null;
                    $valor = null;

                    $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                    foreach ($clientes as $key => $value) {

                      echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].'</option>';
                    }

                ?>
                                  
                </select>

              </div>

              </div>
            

            <!-- ENTRADA PARA LA PLACA-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaPlaca" placeholder="Ingresar placa" required>

              </div>

            </div>
            
            <!-- ENTRADA PARA EL MARCA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-car"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresar marca" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL MODELO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-car"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoModelo" placeholder="Ingresar modelo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL AÑO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-minus-o"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoAnho" placeholder="Ingresar año" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA COLOR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoColor" placeholder="Ingresar color" required>

              </div>

            </div>

             <!-- ENTRADA PARA EL KILOMETRAJE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard "></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoKilometraje" placeholder="Ingresar kilometraje"  required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar vehiculo</button>

        </div>

      </form>
      <?php

          $crearVehiculo = new ControladorVehiculos();
          $crearVehiculo -> ctrCrearVehiculo();

      ?> 
    

    </div>


  </div>
  

</div>
