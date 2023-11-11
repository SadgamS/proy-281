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
        <li > <a href="admordentra"><i class="fa  fa-file-text-o"></i><span>Administrar orden de trabajo</span></a></li>';
        if($_SESSION["perfil"] == "Administrador"){
         echo '<li class="active"> <a href="reportes"><i class="fa fa-line-chart"></i><span>Reporte de orden de trabajo</span></a></li>';
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
      
      Reportes de Ordenes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Reportes de ordenes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="input-group">

          <button type="button" class="btn btn-default" id="daterange-btn2">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

          </button>

        </div>

        <div class="box-tools pull-right">

        <?php

        if(isset($_GET["fechaInicial"])){

          echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

        }else{

           echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';

        }         

        ?>
           
           <button class="btn btn-success" style="margin-top:5px">Descargar reporte en Excel</button>

          </a>

        </div>
         
      </div>

      <div class="box-body">
        
        <div class="row">

          <div class="col-xs-12">
            
            <?php

            include "reportes/grafico-orden.php";

            ?>

          </div>

           <div class="col-md-6 col-xs-12">
             
            <?php

            include "reportes/repuestos-mas-vendidos.php";

            ?>

           </div>

           <div class="col-md-6 col-xs-12">
             
             <?php
 
             include "reportes/servicios-mas-solicitados.php";
 
             ?>
 
            </div>

            <div class="col-md-6 col-xs-12">
             
            <?php

            include "reportes/trabajadores.php";

            ?>

           </div>

           <div class="col-md-12 col-xs-12">
             
            <?php

            include "reportes/clientesM.php";

            ?>

           </div>
          
        </div>

      </div>
      
    </div>

  </section>
 
 </div>
