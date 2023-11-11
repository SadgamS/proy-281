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
      echo '<li class="active">
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

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Administrar Mecanicos
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
    <li class="active">Administrar Mecanicos</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarMecanico">
        Agregar mecanico
      </button>
    </div>
    <div class="box-body">
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
          <tr>
            <th style="width:10px">Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Ci</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Estado</th>
            <th>Fecha de ingreso</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php

        $item = null;
        $valor = null;

        $mecanicos = ControladorMecanicos::ctrMostrarMecanicos($item, $valor);


foreach ($mecanicos as $key => $value){

 echo ' <tr>
      <td>'.($key+1).'</td>
      <td>'.$value["nombre"].'</td>
      <td>'.$value["apellido"].'</td>
      <td>'.$value["ci"].'</td>
      <td>'.$value["telefono"].'</td>';
      echo '<td>'.$value["direccion"].'</td>';

      if($value["estado"] != 0){

        echo '<td><button class="btn btn-success btn-xs btnActivarM" idMecanico="'.$value["id_mecanico"].'" estadoMecanico="0">Disponible</button></td>';

      }else{

        echo '<td><button class="btn btn-danger btn-xs btnActivarM" idMecanico="'.$value["id_mecanico"].'" estadoMecanico="1">Ocupado</button></td>';

      }             

      echo '<td>'.$value["fecha_ingreso"].'</td>
      <td>

        <div class="btn-group">
            
          <button class="btn btn-warning btnEditarMecanico" idMecanico="'.$value["id_mecanico"].'" data-toggle="modal" data-target="#modalEditarMecanico"><i class="fa fa-pencil"></i></button>

          <button class="btn btn-danger btnEliminarMecanico" idMecanico="'.$value["id_mecanico"].'"><i class="fa fa-times"></i></button>

        </div>  

      </td>

    </tr>';
  }


?> 

        </tbody>

      </table>
    </div>
    <!-- /.box-body -->
  
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
</div>

<!---------------------------VENTA MODAL------------------------------------->
<div id="modalAgregarMecanico" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">

<form role="form" method="post" enctype="multipart/form-data">

  <div class="modal-header" style="background:#3c8dbc; color:white">

    <button type="button" class="close" data-dismiss="modal">&times;</button>

    <h4 class="modal-title">Agregar mecanico</h4>
  </div>
  <div class="modal-body">
      <div class="box-body">
         <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
         <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                
                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar ci" required>

              </div>

            </div>
         <!--------Insertar nombre--------->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
          </div>
        </div>
         <!--------Insertar apellido--------->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-users"></i></span>
            <input type="text" class="form-control input-lg" name="nuevoApellido" placeholder="Ingresar apellido" 
            id="nuevoApellido"required>
          </div>
        </div>
        <!--------Insertar telefono--------->

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'999-99999'" data-mask required>
          </div>
        </div>
         <!--------Insertar direccion--------->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
            <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Ingresar dirección" 
            id="nuevoDireccion"required>
          </div>
        </div>

      </div>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
    <button type="submit" class="btn btn-primary">Guardar mecanico </button>
  </div>
    <?php
       $crearMecanico = new ControladorMecanicos();
       $crearMecanico -> ctrCrearMecanico();
    ?>
</form>
</div>

</div>
</div>
<!--=====================================
MODAL EDITAR MECANICO
======================================-->

<div id="modalEditarMecanico" class="modal fade" role="dialog">

<div class="modal-dialog">

<div class="modal-content">

  <form role="form" method="post" enctype="multipart/form-data">

    <!--=====================================
    CABEZA DEL MODAL
    ======================================-->

    <div class="modal-header" style="background:#3c8dbc; color:white">

      <button type="button" class="close" data-dismiss="modal">&times;</button>

      <h4 class="modal-title">Editar mecanico</h4>

    </div>

    <!--=====================================
    CUERPO DEL MODAL
    ======================================-->

    <div class="modal-body">

      <div class="box-body">
          <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="editarDocumentoId" id="editarDocumentoId" required>

              </div>

            </div>

        <!-- ENTRADA PARA EL NOMBRE -->
        
        <div class="form-group">
          
          <div class="input-group">
          
            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

            <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
            <input type="hidden" id="idMecanico" name="idMecanico">

          </div>

        </div>

        <!-- ENTRADA PARA EL APELLIDO -->

         <div class="form-group">
          
          <div class="input-group">
          
            <span class="input-group-addon"><i class="fa fa-users"></i></span> 

            <input type="text" class="form-control input-lg" id="editarApellido" name="editarApellido" value="" required>

          </div>

        </div>

        <!-- ENTRADA PARA EL TELEFONO-->

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono"  data-inputmask="'mask':'999-99999'" data-mask required>
          </div>
        </div>


        <!-- ENTRADA PARA DIRECCION-->

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
            <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion"required>
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

 <?php

      $editarUsuario = new ControladorMecanicos();
      $editarUsuario -> ctrEditarMecanico();

    ?> 

  </form>

</div>

</div>

</div>
<?php

$borrarMecanico = new ControladorMecanicos();
$borrarMecanico -> ctrEliminarMecanico();

?> 
