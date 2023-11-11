<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Taller</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="vistas/img/plantilla/icono.png">

  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">
   <!-- iCheck for checkboxes and radio inputs -->
   <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <!-- DataTables -->
   <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.min.css">
       <!-- Daterange picker -->
    <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">
    <!-- fullCalendar -->
  <link rel="stylesheet" href="vistas/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="vistas/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
   
   
 <!----------plugins--------------------->
  
  <!-- jQuery 3 -->
<script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="vistas/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="vistas/dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
<!-- DataTables -->
<script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
   <!-- iCheck 1.0.1 -->
   <script src="vistas/plugins/iCheck/icheck.min.js"></script>
     <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>
 <!-- Select2 -->
<script src="vistas/bower_components/select2/dist/js/select2.full.min.js"></script>
 <!-- jQuery Number -->
 <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

 <!-- daterangepicker http://www.daterangepicker.com/-->
 <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

   <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
   <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="vistas/bower_components/chart.js/Chart.js"></script>

  <!-- fullCalendar -->
<script src="vistas/bower_components/moment/moment.js"></script>
<script src="vistas/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="vistas/bower_components/fullcalendar/dist/locale/es.js"></script>
  
</head>

<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->


  <?php
    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"]=="ok") {
      
    
    echo '<div class="wrapper">';
      include "modulos/cabezote.php";

      include "modulos/menu.php";

      if (isset($_GET["ruta"])) {
          if ($_GET["ruta"]=="inicio" || 
              $_GET["ruta"]=="usuarios" ||
              $_GET["ruta"]=="inventario"||
              $_GET["ruta"]=="categorias"||
              $_GET["ruta"]=="repuestos"||
              $_GET["ruta"]=="ordentrabajo"||
              $_GET["ruta"]=="clientes"||  
              $_GET["ruta"]=="vehiculos"|| 
              $_GET["ruta"]=="servicios"||
              $_GET["ruta"]=="mecanicos"||
              $_GET["ruta"]=="ver_orden"||
              $_GET["ruta"]=="admordentra"||
              $_GET["ruta"]=="reportes"||  
              $_GET["ruta"]=="citas"||
              $_GET["ruta"]=="admcitas"||         
              $_GET["ruta"]=="salir") {
            include "modulos/".$_GET["ruta"].".php";
          }else {
            include "modulos/404.php";
          }
      }else {
        include "modulos/inicio.php";
      }


      include "modulos/footer.php";
      echo '</div>';
    }else {
      include "modulos/login.php";
    }
  ?>

 
  


<!-- ./wrapper -->

<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/categorias.js"></script>
<script src="vistas/js/repuestos.js"></script>
<script src="vistas/js/clientes.js"></script>
<script src="vistas/js/vehiculo.js"></script>
<script src="vistas/js/servicios.js"></script>
<script src="vistas/js/mecanicos.js"></script>
<script src="vistas/js/order_trabajo.js"></script>
<script src="vistas/js/reportes.js"></script>
<script src="vistas/js/citas.js"></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
</body>
</html>
