

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Resumen
        <small>Administración</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Resumen</li>
      </ol>
  </section>

  <section class="content">

<div class="row">
  
<?php

if($_SESSION["perfil"] =="Administrador"){

  include "inicio/cajas-superiores.php";

}

?>


 <div class="row">
   
    <div class="col-lg-12">

      <?php

      if($_SESSION["perfil"] =="Administrador"){
      
       include "reportes/grafico-orden.php";

      }

      ?>

    </div>

 

    <div class="col-lg-6">

      <?php

      if($_SESSION["perfil"] =="Administrador"){
      
       include "reportes/repuestos-mas-vendidos.php";

     }

      ?>

    </div>
    <div class="col-lg-6">

<?php

if($_SESSION["perfil"] =="Administrador"){

include "inicio/caja-citas.php";

}

?>

</div>

    <div class="col-lg-6">

      <?php

        if($_SESSION["perfil"] =="Administrador"){

        include "reportes/servicios-mas-solicitados.php";

        }

        ?>

      </div>


     <div class="col-lg-6">

      <?php

      if($_SESSION["perfil"] =="Administrador"){
      
       include "inicio/repuestos-recientes.php";

     }

      ?>

    </div>

     <div class="col-lg-12">
       
      <?php

      if($_SESSION["perfil"] =="Mecanico" || $_SESSION["perfil"] =="Encargado"){

        include "inicio/calendario.php";

      }

      ?>

     </div>
     


</div> 

 </div>

</section>
  </div>