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
        <li class="active">
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
        Administrar Usuarios
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Administrar Usuarios</li>
      </ol>
  </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
            Agregar usuario
          </button>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            <thead>
              <tr>
                <th style="width:10px">Id</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Ultimo login</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
            <?php

            $item = null;
    $valor = null;

    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
   

    foreach ($usuarios as $key => $value){
 
     echo ' <tr>
          <td>'.$value["id"].'</td>
          <td>'.$value["nombre"].'</td>
          <td>'.$value["usuario"].'</td>';

          if($value["foto"] != ""){

            echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

          }else{

            echo '<td><img src="vistas/img/usuarios/defecto/user-solid.png" class="img-thumbnail" width="40px"></td>';

          }

          echo '<td>'.$value["perfil"].'</td>';

          if($value["estado"] != 0){

            echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';

          }else{

            echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';

          }             

          echo '<td>'.$value["ultimo_login"].'</td>
          <td>

            <div class="btn-group">
                
              <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

              <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>

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
  <div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Usuario</h4>
      </div>
      <div class="modal-body">
          <div class="box-body">
             <!--------Insertar nombre--------->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
              </div>
            </div>
             <!--------Insertar usuario--------->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" 
                id="nuevoUsuario"required>
              </div>
            </div>
            <!--------Insertar contraseña--------->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>
              </div>
            </div>
             <!--------Insertar tipo de usuario--------->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoPerfil" >
                  <option value="">Selecionar perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Encargado">Encargado</option>
                  <option value="Mecanico">Mecanico</option>
                </select>
              </div>
            </div>
             <!-- subir foto -->
             <div class="form-group">
               <div class="panel ">SUBIR FOTO</div>
               <input type="file" class="nuevaFoto" name="nuevaFoto">
               <p class="help-block">Peso máximo de la foto 2MB</p>
               <img src="vistas/img/usuarios/defecto/user-solid.png" class="img-thumbnail previsualizar" width="100px">
            </div>

          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Guardar usuario </button>
      </div>
        <?php
           $crearUsuario = new ControladorUsuarios();
           $crearUsuario -> ctrCrearUsuario();
        ?>
    </form>
    </div>

  </div>
</div>
<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

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

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="editarPerfil">
                  
                  <option value="" id="editarPerfil"></option>

                  <option value="Administrador">Administrador</option>

                  <option value="Encargado">Encargado</option>
                  <option value="Mecanico">Mecanico</option>

                  

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/defecto/user-solid.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>

     <?php

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();

        ?> 

      </form>

    </div>

  </div>

</div>
<?php

  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();

?> 
