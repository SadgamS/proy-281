<?php

if($_SESSION["perfil"] == "Mecanico" ){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

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
       echo '<li class="treeview">
            <a href="#">
                <i class="fa fa-gears"></i>
                <span>Trabajos</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            <li> <a href="ordentrabajo"><i class="fa fa-gear"></i><span>Crear orden de trabajo</span></a></li>
            <li> <a href="admordentra"><i class="fa  fa-file-text-o"></i><span>Administrar orden de trabajo</span></a></li>';
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
        <li class="active">
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
      
      Administrar vehiculos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar vehiculos</li>
    
    </ol>

  </section>

  <section class="content">
 

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarVehiculo">
          
          Agregar vehiculo

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas"  width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Placa</th>
           <th>Marca</th>
           <th>Modelo</th>
           <th>Año</th>
           <th>Color</th>
           <th>Propietario</th>
           <th>kilometraje</th>
           <th>Nro arreglos</th>  
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
        <?php

            $item = null;
            $valor = null;

            $vehiculos = ControladorVehiculos::ctrMostrarVehiculos($item, $valor);
            foreach ($vehiculos as $key => $value) {
            

              echo '<tr>
  
                      <td>'.($key+1).'</td>
  
                      <td>'.$value["placa"].'</td>
  
                      <td>'.$value["marca"].'</td>
  
                      <td>'.$value["modelo"].'</td>
  
                      <td>'.$value["anho"].'</td>
  
                      <td>'.$value["color"].'</td>';

                      $item = "id_cliente";
                      $valor = $value["id_cliente"];
    
                      $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
                      
                      echo '<td>'.$cliente["nombre"].'</td>
                     
  
                      <td>'.$value["kilometraje"].'</td>
                      
                      <td>'.$value["nro_arreglos"].'</td>     
  
                      <td>
  
                        <div class="btn-group">
                            
                          <button class="btn btn-warning btnEditarVehiculo" data-toggle="modal" data-target="#modalEditarVehiculo" idVehiculo="'.$value["id_vehiculo"].'"><i class="fa fa-pencil"></i></button>
  
                          <button class="btn btn-danger btnEliminarVehiculo" idVehiculo="'.$value["id_vehiculo"].'"><i class="fa fa-times"></i></button>
  
                        </div>  
  
                      </td>
  
                    </tr>';
            
              }

        ?>
          
         

          
        </tbody>

       </table>

      </div>

    </div>

  </section>

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

                <select class="form-control select2 " id="nuevoPropietario"  name="nuevoPropietario" style="width: 100%;" required>
                
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

<!--=====================================
MODAL EDITAR VEHICULO
======================================-->

<div id="modalEditarVehiculo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Vehiculo</h4>

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

                <select class="form-control input-lg " name="editarPropietario" readonly required>
                
                <option id="editarPropietario"></option>
           
                                  
                </select>

              </div>

              </div>
            

            <!-- ENTRADA PARA LA PLACA-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" name="editarPlaca" id="editarPlaca" required>
                <input type="hidden" id="idVehiculo" name="idVehiculo">

              </div>

            </div>
            
            <!-- ENTRADA PARA EL MARCA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-car"></i></span> 

                <input type="text" class="form-control input-lg" name="editarMarca" id="editarMarca"  required>

              </div>

            </div>

            <!-- ENTRADA PARA EL MODELO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-car"></i></span> 

                <input type="text" class="form-control input-lg" name="editarModelo" id="editarModelo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL AÑO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-minus-o"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="editarAnho" id="editarAnho" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA COLOR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span> 

                <input type="text" class="form-control input-lg" name="editarColor" id="editarColor" required>

              </div>

            </div>

             <!-- ENTRADA PARA EL KILOMETRAJE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard "></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="editarKilometraje" id="editarKilometraje"   required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>
      <?php

          $editarVehiculo = new ControladorVehiculos();
          $editarVehiculo -> ctrEditarVehiculo();

        ?> 

    </div>


  </div>
  

</div>
<?php

  $eliminarVehiculo = new ControladorVehiculos();
  $eliminarVehiculo -> ctrEliminarVehiculo();

?>  