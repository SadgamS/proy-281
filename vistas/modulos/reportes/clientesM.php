<?php

$item=null;
$valor=null;

$orden= ControladorOrdenTrabajo::ctrMostrarOrden($item,$valor);

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

$arrayClientes = array();
$arraylistaClientes = array();

foreach ($orden as $key => $valueOrden) {
  
  foreach ($clientes as $key => $valueClientes) {
    
      if($valueClientes["id_cliente"] == $valueOrden["id_cliente"]){

        #Capturamos los Clientes en un array
        array_push($arrayClientes, $valueClientes["nombre"]);

        #Capturamos las nombres y los valores netos en un mismo array
        $arraylistaClientes = array($valueClientes["nombre"] => $valueOrden["neto"]);

        #Sumamos los netos de cada cliente
        foreach ($arraylistaClientes as $key => $value) {
          
          $sumaTotalClientes[$key] += $value;
        
        }

      }   
  }

}

#Evitamos repetir nombre
$noRepetirNombres = array_unique($arrayClientes);


?>



<div class="box box-primary">
	
	<div class="box-header with-border">
    
    	<h3 class="box-title">Clientes recurrentes</h3>
  
  	</div>

  	<div class="box-body">
  		
		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart2" style="height: 300px;"></div>

		</div>

  	</div>

</div>
<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart2',
  resize: true,
  data: [
     <?php
    
    foreach($noRepetirNombres as $value){

      echo "{y: '".$value."', a: '".$sumaTotalClientes[$value]."'},";

    }

  ?>
  ],
  barColors: ['#f6a'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['trabajos'],
  preUnits: 'Bs.',
  hideHover: 'auto'
});


</script>