<?php
 
  require_once "controladores/plantilla.controlador.php";
  require_once "controladores/usuarios.controlador.php";
  require_once "controladores/categorias.controlador.php";
  require_once "controladores/repuestos.controlador.php";
  require_once "controladores/orden_trabajo.controlador.php";
  require_once "controladores/clientes.controlador.php";
  require_once "controladores/vehiculo.controlador.php";
  require_once "controladores/servicios.controlador.php";
  require_once "controladores/mecanicos.controlador.php";
  require_once "controladores/orden_trabajo.controlador.php";
  require_once "controladores/citas.controlador.php";

  require_once "modelos/usuarios.modelo.php";
  require_once "modelos/categorias.modelo.php";
  require_once "modelos/repuestos.modelo.php";
  require_once "modelos/orden_trabajo.modelo.php";
  require_once "modelos/clientes.modelo.php";
  require_once "modelos/vehiculo.modelo.php";
  require_once "modelos/servicios.modelo.php";
  require_once "modelos/mecanicos.modelo.php";
  require_once "modelos/orden_trabajo.modelo.php";
  require_once "modelos/citas.modelo.php";

  $plantilla=new ControladorPlantilla();

  $plantilla -> ctrPlantilla();