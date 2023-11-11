<?php

$item=null;
$valor=null;

$orden= ControladorOrdenTrabajo::ctrMostrarOrden($item,$valor);

$mecanicos= ControladorMecanicos::ctrMostrarCantidadTrabajos();




?>

<!--=====================================
MECANICOS
======================================-->

<div class="box box-success">
	
	<div class="box-header with-border">
    
    	<h3 class="box-title">Cantidad de trabajos realizados por mecanicos</h3>
  
  	</div>

  	<div class="box-body">
  		
		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart1" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart1',
  resize: true,
  data: [

  <?php

    foreach($mecanicos as $key => $value){

      echo "{y: '".$value["nombre"]."', a: '".$value["suma"]."', b: '".$value["nro_trabajos"]."'},";

    }

  ?>
  ],
  barColors: ['#0af','#f56954'],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Total Bs.','Nro. trabajos'],
  hideHover: 'auto'
});


</script>