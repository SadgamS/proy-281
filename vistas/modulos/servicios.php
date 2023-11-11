<?php

if($_SESSION["perfil"] == "Mecanico"){

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
        <li>
            <a href="vehiculos">
                <i class="fa fa-car"></i>
                <span>Vehiculos</span>
            </a>
        </li>';
  }
  if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Encargado"){ 
        echo '<li class="active"> 
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
      
      Administrar servicios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar servicios</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarServicio">
          
          Agregar Servicio

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Servicio</th>
           <th>Costo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          
        <?php

            $item = null;
            $valor = null;

            $servicios = ControladorServicios::ctrMostrarServicios($item, $valor);

            foreach ($servicios as $key => $value) {
              

              echo '<tr>

                      <td>'.($key+1).'</td>

                      <td>'.$value["nombre_servicio"].'</td>

                      <td>'.$value["costo"].'</td>


                      <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-warning btnEditarServicio" data-toggle="modal" data-target="#modalEditarServicio" idServicio="'.$value["id_servicio"].'"><i class="fa fa-pencil"></i></button>

                          <button class="btn btn-danger btnEliminarServicio" idServicio="'.$value["id_servicio"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR SERVICIO
======================================-->

<div id="modalAgregarServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar servicio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-wrench"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoServicio" placeholder="Ingresar servicio" required>

              </div>

            </div>

              <!-- ENTRADA PARA EL COSTO -->
            
              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoCosto" placeholder="Ingresar costo del servicio" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar servicio</button>

        </div>

      </form>
      <?php

        $crearServicio = new ControladorServicios();
        $crearServicio -> ctrCrearServicio();

    ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SERVICIO
======================================-->

<div id="modalEditarServicio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar servicio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">

            <div class="box-body">

              <!-- ENTRADA PARA EL NOMBRE -->
              
              <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-wrench"></i></span> 

                  <input type="text" class="form-control input-lg" name="editarServicio" id="editarServicio"  required>
                  <input type="hidden" id="idServicio" name="idServicio">

                </div>

              </div>

                <!-- ENTRADA PARA EL COSTO -->
              
                <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                  <input type="number" class="form-control input-lg" name="editarCosto" id="editarCosto" required>

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

        $editarServicio = new ControladorServicios();
        $editarServicio -> ctrEditarServicio();

      ?>

    

    </div>

  </div>

</div>

<?php

  $eliminarServicio = new ControladorServicios();
  $eliminarServicio -> ctrEliminarServicio();

?>