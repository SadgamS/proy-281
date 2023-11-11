<?php

if($_SESSION["perfil"] == "Mecanico" || $_SESSION["perfil"] == "Encargado"){

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
echo '<li class="active treeview">
    <a href="#">
        <i class="fa fa-calendar"></i>
        <span>Citas</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
     </a>
     <ul class="treeview-menu">
       <li > <a href="citas">
          <i class="fa fa-calendar-plus-o"></i>
          <span>Crear Citas</span>
        </a>
      </li>
      <li class="active">
      <a href="admcitas">
      <i class="fa fa-calendar-plus-o"></i>
      <span>Administrar Citas</span>
     </a>
     </li>
  </ul>
  </li>';
}
?>
</ul>


</section>


</aside>
<div class="content-wrapper">


  <section class="content-header">
      <h1>
        Administrar Citas
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Administrar Citas</li>
      </ol>
  </section>


    <section class="content">


      <div class="box">
        <div class="box-header with-border">
        <a href="citas">
            <button class="btn btn-primary">
                Agregar citas
            </button>
          </a>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Descripción</th>
           
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
            <?php
                    $item = null;
                    $valor = null;
                
                    $citas = ControladorCitas::ctrMostrarCitas($item, $valor);
                    foreach ($citas as $key => $value) {
                        echo '<tr>
                            <td>'.($key+1).'</td>';
                            $item = "id_cliente";
                            $valor = $value["id_cliente"];
    
                             $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);

                           echo '<td>'.$cliente["nombre"].'</td>
                            <td>'.substr($value["fecha"],0,10).'</td>
                            <td>'.substr($value["fecha"],11).'</td>
                            <td>'.$value["descripcion"].'</td>
                             <td>
                           <div class="btn-gruop">
                             <button class="btn btn-warning btnEditarCita" idCita="'.$value["id_cita"].'" data-toggle="modal" data-target="#modalEditarCita"><i class="fa fa-pencil"></i></button>
                             <button class="btn btn-danger btnEliminarCita" idCita="'.$value["id_cita"].'"><i class="fa fa-times"></i></button>
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
MODAL EDITAR CITA
======================================-->

  <div id="modalEditarCita" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar Cita</h4>
      </div>
      <div class="modal-body">
          <div class="box-body">
             <!-------Editar Cliente--------->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg"   name="editarCcliente"  required>
                <option  id="editarCcliente" ></option>
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
             <!--------FECHA Y HORA--------->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                <input type="text" class="form-control input-lg" name="editarFechaH" id="editarFechaH" value="" required>
                <input type="hidden" id="idCita" name="idCita">
             
              </div>
            </div>

            <!--------DESCRIPCION--------->
            <div class="form-group">
                  <label>Descripción</label>
                  <textarea class="form-control" rows="3" name="editarDesc" id="editarDesc" value="" placeholder="Ingrese una descripción..."></textarea>
                </div>
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Guardar cambios </button>
      </div>
      <?php
           $editarCita = new ControladorCitas();
           $editarCita -> ctrEditarCita();
        ?>

    </form>
    </div>

  </div>
</div>
<?php

  $borrarCita = new ControladorCitas();
  $borrarCita -> ctrEliminarCita();

?> 
