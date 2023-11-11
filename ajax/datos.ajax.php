<?php

$conexion=mysqli_connect('localhost','root','','bdtmecanica');
$id_cliente=$_POST['id_cliente'];

	$sql="SELECT id_vehiculo,marca,placa,modelo 
		from vehiculo 
		where id_cliente='$id_cliente'";

	$result=mysqli_query($conexion,$sql);


	foreach ($result as $key => $value) {
		$cadena=$cadena.'<option value="'.$value["id_vehiculo"].'">'.$value["marca"] .'  '.$value["modelo"] .'  '. $value["placa"]. '</option>';
	}



	echo  $cadena;


	$conexion=null;