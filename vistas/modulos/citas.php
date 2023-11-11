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
       <li class="active"> <a href="citas">
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
        Crear Cita
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Crear Cita</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->

              <div id="calendar"></div>

            </div>
       
          </div>
          
        </div>
       
      </div>
    
    </section>


</div>


  <!---------------------------AGREGAR CITA------------------------------------->
  <div id="modalAgregarCita" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Cita</h4>
      </div>
      <div class="modal-body">
          <div class="box-body">
             <!--------Insertar Cliente--------->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control select2 " id="nuevoCcliente"  name="nuevoCcliente" style="width: 100%;" required>
                <option value="">Selecionar cliente</option>
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
                <input type="text" class="form-control input-lg" name="nuevoFechaH" id="nuevoFechaH" readonly required>
             
              </div>
            </div>

            <!--------DESCRIPCION--------->
            <div class="form-group">
                  <label>Descripción</label>
                  <textarea class="form-control" rows="3" name="nuevoDesc" placeholder="Ingrese una descripción..."></textarea>
                </div>
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Guardar cita </button>
      </div>
      <?php
           $crearCita = new ControladorCitas();
           $crearCita -> ctrCrearCita();
        ?>

    </form>
    </div>

  </div>
</div>

<script>
    /* iniciar calendario
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
        hiddenDays:[0],
        defaultView: 'agendaWeek',
        dayClick:function(date,jsEvent,view){
            $('#modalAgregarCita').modal();
            
            var fecha= date.format();
     
            fecha=fecha.split("T");
            var dia=fecha[0];
            var hora=(fecha[1].split(":"));
            var h1=hora[0];
           
            h1 = h1+":00:00";

            var fechaH= dia+" "+h1;
            $('#nuevoFechaH').val(fechaH);
        },
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'hoy',
        month: 'mes',
        week : 'semana',
        day  : 'día'
      },
      
      events    : [
          <?php
            $item=null;
            $valor=null;
            $citas = ControladorCitas::ctrMostrarCitas($item,$valor);


            foreach ($citas as $key => $value) {
                $itemC = "id_cliente";
                $valorC = $value["id_cliente"];
    
                 $cliente = ControladorClientes::ctrMostrarClientes($itemC, $valorC);
                
                $horafin=intval(substr($value["fecha"],11,2))+1;

                if ($horafin>9) {
                    $fechafin = substr($value["fecha"],0,10)." ".$horafin.":00:00";
                }else{
                    $fechafin = substr($value["fecha"],0,10)." 0".$horafin.":00:00";
                }

                    echo "{
                        title          : '".$cliente["nombre"]."  ".$value["descripcion"]."',
                        start          : '".$value["fecha"]."',
                        end            : '".$fechafin."',
                        backgroundColor: '#00a65a',
                        borderColor    : '#00a65a' 
                    },";
            }
          
          ?>
  
      ]
    })

</script>