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
            <li > <a href="ordentrabajo"><i class="fa fa-gear"></i><span>Crear orden de trabajo</span></a></li>
            <li class="active"> <a href="admordentra"><i class="fa  fa-file-text-o"></i><span>Administrar orden de trabajo</span></a></li>';
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
      
      Administrar orden de trabajo
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar orden de trabajo</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="ordentrabajo">

          <button class="btn btn-primary">
            
            Agregar orden de trabajo

          </button>

        </a>
        
        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
           
           <span>
             <i class="fa fa-calendar"></i> Rango de fecha
           </span>

           <i class="fa fa-caret-down"></i>

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nro orden</th>
           <th>Cliente</th>
           <th>Vehiculo</th>
           <th>Mecanico</th>
           <th>Neto</th>
           <th>Total</th> 
           <th>Fecha</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          <?php
              
              if(isset($_GET["fechaInicial"])){

                $fechaInicial = $_GET["fechaInicial"];
                $fechaFinal = $_GET["fechaFinal"];
    
              }else{
    
                $fechaInicial = null;
                $fechaFinal = null;
    
              }
    
              $respuesta = ControladorOrdenTrabajo::ctrRangoFechasOrden($fechaInicial, $fechaFinal);

              foreach ($respuesta as $key => $value) {
                echo '
                <tr>
      
                  <td>'.($key+1).'</td>
      
                  <td>'.$value["nro_orden"].'</td>';


                  $itemCliente = "id_cliente";
                  $valorCliente =  $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
      
                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                  $itemVehiculo = "id_vehiculo";
                  $valorVehiculo = $value["id_vehiculo"];

                  $respuestaVehiculo = ControladorVehiculos::ctrMostrarVehiculos($itemVehiculo, $valorVehiculo);
      
                  echo '<td>'.$respuestaVehiculo["marca"].' '.$respuestaVehiculo["placa"].'</td>';

      
                  $itemMecanico = "id_mecanico";
                  $valorMecanico = $value["id_mecanico"];

                  $respuestaMecanico = ControladorMecanicos::ctrMostrarMecanicos($itemMecanico, $valorMecanico);

                  echo '<td>'.$respuestaMecanico["nombre"].' '.$respuestaMecanico["apellido"].'</td>
      
                  <td>'.number_format($value["neto"],2).'</td>
      
                  <td>'.number_format($value["total"],2).'</td>
      
                  <td>'.$value["fecha"].'</td>
      
                  <td>
      
                    <div class="btn-group">
                        
                      <button class="btn btn-primary btnImprimirOrden" codigo="'.$value["nro_orden"].'"><i class="fa  fa-file-pdf-o"></i></button>';
                      if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Encargado"){

                      echo '<button class="btn btn-info btnVerOrden" idOrden="'.$value["id_orden"].'"><i class="fa  fa-eye"></i></button>';
                      }
                      if($_SESSION["perfil"] == "Administrador"){
                      echo '<button class="btn btn-danger btnEliminarOrden"  idOrden="'.$value["id_orden"].'"><i class="fa fa-times"></i></button>';
                      }
                    echo '</div>  
      
                  </td>
      
                </tr>';

              }

          ?>
        </tbody>

       </table>
       
       <?php

      $eliminarOrden = new ControladorOrdenTrabajo();
      $eliminarOrden -> ctrEliminarOrden();

      ?>
       

      </div>

    </div>

  </section>

</div>
