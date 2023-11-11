<?php

require_once "../../controladores/orden_trabajo.controlador.php";
require_once "../../modelos/orden_trabajo.modelo.php";
require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";
require_once "../../controladores/mecanicos.controlador.php";
require_once "../../modelos/mecanicos.modelo.php";

$reporte = new ControladorOrdenTrabajo();
$reporte -> ctrDescargarReporte();