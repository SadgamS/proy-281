<?php

$item = null;
$valor = null;


$oredenes = ControladorOrdenTrabajo::ctrSumaTotalTrabajos();



$servicios = ControladorServicios::ctrMostrarServicios($item, $valor);
$totalServicios = count($servicios);

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes);

$productos = ControladorRepuestos::ctrMostrarRepuestos($item, $valor);
$totalProductos = count($productos);

?>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3>$<?php echo number_format($oredenes["total"],2); ?></h3>

      <p>Trabajos Realizados</p>
    
    </div>
    
    <div class="icon">
      
      <i class="ion ion-social-usd"></i>
    
    </div>
    
    <a href="admordentra" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
      <h3><?php echo number_format($totalServicios); ?></h3>

      <p>Servicios</p>
    
    </div>
    
    <div class="icon">
    
      <i class="fa fa-wrench"></i>
    
    </div>
    
    <a href="servicios" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3><?php echo number_format($totalClientes); ?></h3>

      <p>Clientes</p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion ion-person-add"></i>
    
    </div>
    
    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">
  
    <div class="inner">
    
      <h3><?php echo number_format($totalProductos); ?></h3>

      <p>Repuestos</p>
    
    </div>
    
    <div class="icon">
      
      <i class="fa fa-cog"></i>
    
    </div>
    
    <a href="repuestos" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

