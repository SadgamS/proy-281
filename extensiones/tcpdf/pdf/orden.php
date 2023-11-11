<?php
require_once "../../../controladores/orden_trabajo.controlador.php";
require_once "../../../modelos/orden_trabajo.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/vehiculo.controlador.php";
require_once "../../../modelos/vehiculo.modelo.php";

require_once "../../../controladores/mecanicos.controlador.php";
require_once "../../../modelos/mecanicos.modelo.php";

class imprimirOrden{

public $codigo;

public function traerImpresionOrden(){
//TRAEMOS LA INFORMACIÓN DEL ORDEN
$itemOrden = "nro_orden";
$valorOrden = $this->codigo;

$respuestaOrden = ControladorOrdenTrabajo::ctrMostrarOrden($itemOrden, $valorOrden);

$fecha = substr($respuestaOrden["fecha"],0,-8);
$neto = number_format($respuestaOrden["neto"],2);
$impuesto = number_format($respuestaOrden["impuesto"],2);
$total = number_format($respuestaOrden["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id_cliente";
$valorCliente = $respuestaOrden["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VEHICULO

$itemVehiculo = "id_vehiculo";
$valorVehiculo = $respuestaOrden["id_vehiculo"];

$respuestaVehiculo = ControladorVehiculos::ctrMostrarVehiculos($itemVehiculo, $valorVehiculo);

//TRAEMOS LA INFORMACIÓN DEL MECANICO

$itemMecanico = "id_mecanico";
$valorMecanico = $respuestaOrden["id_mecanico"];

$respuestaMecanico = ControladorMecanicos::ctrMostrarMecanicos($itemMecanico, $valorMecanico);


//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();


$bloque1 = <<<EOF

        <table>
            <tr>
                     <td style="width:150px"><img src="images/logo.jpg"></td>

                     <td style="background-color:white; width:100px">
				
                     <div style="font-size:8.5px; text-align:center; line-height:15px;">
          
                         NIT: 11111111
     
                         <br>
                         Dirección: Calle 12
     
                     </div>
                 </td>

                 <td style="background-color:white; width:140px">

                 <div style="font-size:8.5px; text-align:left; line-height:15px;">
                     
                     Teléfono: 221 2213
                     
                     <br>
                    Correo: admintaller@gmail.com
 
                 </div>
                 
             </td>
 
             <td style=" background-color:white; width:150px; text-align:center; color:#204A9E"><br><br>ORDEN DE TRABAJO<br>Nro. $valorOrden<br>Fecha: $fecha</td>


            </tr>

        </table>



EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

    <table>
            
    <tr>
        
        <td style="width:540px"><img src="images/back.jpg"></td>

    </tr>

    </table>

    <table style=" border: 1px solid #666; font-size:8px; padding:5px 10px; ">

        <tr>
            <td style="border-bottom: 1px solid #666; background-color:white; width:220px; text-align: center; color:#204A9E; font-size:10px; font-weight: bold;">Datos Cliente </td>
            <td style="border-left: 1px solid #666; border-bottom: 1px solid #666; background-color:white; width:320px; text-align: center; color:#204A9E; font-size:10px; font-weight: bold;">Datos Vehiculo</td>     
        </tr>

        <tr>
            <td style=" border-bottom: 1px solid #666; background-color:white; width:70px; font-weight: bold;">Cliente:</td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:150px; text-align: left;">$respuestaCliente[nombre]</td>

            <td style=" border-left: 1px solid #666; border-bottom: 1px solid #666; background-color:white; width:50px; font-weight: bold;">Placa:</td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:120px; text-align: left;">$respuestaVehiculo[placa]</td> 
            
            <td style=" border-left: 1px solid #666; border-bottom: 1px solid #666; background-color:white; width:50px; font-weight: bold;">Color:</td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align: left;">$respuestaVehiculo[color]</td> 

        </tr>

        <tr>
            <td style="border-bottom: 1px solid #666; background-color:white; width:70px; font-weight: bold;">Ci: </td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:150px; text-align: left;">$respuestaCliente[ci]</td>
            
            <td style=" border-left: 1px solid #666; border-bottom: 1px solid #666; background-color:white; width:50px; font-weight: bold;">Marca:</td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:120px; text-align: left;">$respuestaVehiculo[marca]</td>
            
            <td style=" border-left: 1px solid #666; border-bottom: 1px solid #666; background-color:white; width:60px; font-weight: bold;">Modelo:</td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:90px; text-align: left;">$respuestaVehiculo[modelo]</td> 

        </tr>

        <tr>
            <td style="border-bottom: 1px solid #666; background-color:white; width:70px; font-weight: bold;">Telefono: </td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:150px; text-align: left;">$respuestaCliente[telefono]</td>
            
            <td style=" border-left: 1px solid #666; border-bottom: 1px solid #666; background-color:white; width:80px; font-weight: bold;">Kilometraje:</td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:240px; text-align: left;">$respuestaVehiculo[kilometraje]</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #666; background-color:white; width:70px; font-weight: bold;">Dirección: </td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:150px; text-align: left;">$respuestaCliente[direccion]</td> 
            
            <td style=" border-left: 1px solid #666; border-bottom: 1px solid #666; background-color:white; width:50px; font-weight: bold;">Año:</td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:60px; text-align: left;">$respuestaVehiculo[anho]</td> 

            <td style=" border-left: 1px solid #666; border-bottom: 1px solid #666; background-color:white; width:100px; font-weight: bold;">Nro de Arreglos:</td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:110px; text-align: left;">$respuestaVehiculo[nro_arreglos]</td> 
        </tr>
       
        <tr>
            <td style=" border-bottom: 1px solid #666; background-color:white; width:540px; text-align: center; color:#204A9E; font-size:10px; font-weight: bold;">Datos Mecanico Encargado</td> 
        </tr>

        <tr>
            <td style=" border-bottom: 1px solid #666; background-color:white; width:70px; font-weight: bold;">Nombre:</td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align: left;">$respuestaMecanico[nombre]</td>

            <td style=" border-left: 1px solid #666; border-bottom: 1px solid #666; background-color:white; width:70px; font-weight: bold;">Apellido:</td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align: left;">$respuestaMecanico[apellido]</td> 
            
            <td style=" border-left: 1px solid #666; border-bottom: 1px solid #666; background-color:white; width:70px; font-weight: bold;">Telefono:</td>
            <td style="border-bottom: 1px solid #666; background-color:white; width:130px; text-align: left;">$respuestaMecanico[telefono]</td> 

        </tr>


       
    </table>


EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF
    
    <table style="font-size:10px; padding:5px 10px;">
    <tr>
		
    <td style="border:none; background-color:white; width:540px"> </td>

    </tr>
	<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px;  color:#204A9E; font-size:10px; font-weight: bold " >Servicios Realizados</td>

	</tr>
		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:280px; text-align:center; font-weight: bold;">Servicio</td>
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center; font-weight: bold;">Costo</td>
	

		</tr>

	</table>

EOF;


$pdf->writeHTML($bloque3, false, false, false, false, '');
// ---------------------------------------------------------

$servicios= ModeloOrdenTrabajo::mdlMostrarOrdenServicios($respuestaOrden["id_orden"]);

foreach ($servicios as $key => $item) {

$costo= number_format($item["costo"],2);

$bloque4 = <<<EOF

    <table style="font-size:10px; padding:5px 10px;">

        <tr>
            
            <td style="border: 1px solid #666; color:#333; background-color:white; width:280px; text-align:center">
                $item[nombre_servicio]
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                Bs. $costo 
            </td>

        
        </tr>

    </table>
    
EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}
//------------------------------------------------------------------

$bloque5 = <<<EOF
    
<table style="font-size:10px; padding:5px 10px;">
    <tr>
		
        <td style="border:none; background-color:white; width:540px"> </td>

    </tr>
	<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px;  color:#204A9E; font-size:10px; font-weight: bold " >Repuestos Utilizados</td>

	</tr>

    <tr>

        <td style="border: 1px solid #666; background-color:white; width:260px; text-align:center; font-weight: bold;">Repuesto</td>
        <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center; font-weight: bold;">Cantidad</td>
        <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center; font-weight: bold;">Valor Unit.</td>
        <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center; font-weight: bold;">Valor Total</td>

    </tr>

</table>

EOF;


$pdf->writeHTML($bloque5, false, false, false, false, '');

//-------------------------------------------------------------------

$repuestos= ModeloOrdenTrabajo::mdlMostrarOrdenRepuestos($respuestaOrden["id_orden"]);

foreach ($repuestos as $key => $itemR) {

$precioUnitario = number_format($itemR["precio"],2);

$precioTotal= number_format($itemR["total"],2);

$bloque6 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$itemR[tipo_repuesto]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$itemR[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">Bs. 
				$precioUnitario
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">Bs. 
				$precioTotal
			</td>


		</tr>

	</table>


EOF;
$pdf->writeHTML($bloque6, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque7 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center; font-weight: bold;">
				Neto:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				Bs. $neto
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center; font-weight: bold;">
				Impuesto:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				Bs. $impuesto
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center; font-weight: bold;">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				Bs. $total
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');

//SALIDA DEL ARCHIVO  

$pdf->Output('orden'.$respuestaOrden["nro_orden"].'.pdf');

//$pdf->Output('orden.pdf', 'D');
    
}


}
    
$Orden = new imprimirOrden();
$Orden -> codigo = $_GET["codigo"];
$Orden -> traerImpresionOrden();

?>