<?php

$item = null;
$valor = null;






$citas = ControladorCitas::ctrMostrarCitas($item, $valor);
$totalCitas= count($citas);



?>



  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3><?php echo number_format($totalCitas); ?></h3>

      <p>CItas</p>
    
    </div>
    
    <div class="icon">
    
      <i class="fa fa-calendar"></i>
    
    </div>
    
    <a href="citas" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

