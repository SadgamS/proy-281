<?php


?>

<aside class="main-sidebar">

    <section class="sidebar">
    <div class="user-panel">
     
      </div>
        
        <ul class="sidebar-menu">

        <li class="header">PANEL ADMINISTRADOR</li>
        <?php

    if($_SESSION["perfil"] == "Administrador"){
      echo  '<li data-widget="tree">
            <a href="inicio">
                <i class="fa fa-home"></i>
                <span>Inicio</span>
            </a>

        </li>
        <li>
            <a href="usuarios">
                <i class="fa fa-user"></i>
                <span>Usuarios</span>
            </a>

        </li>';
  }

  if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Encargado" || $_SESSION["perfil"] == "Mecanico"){

      echo '<li class="active treeview">
            <a href="#">
                <i class="fa fa-th"></i>
                <span>Inventario</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">';
            if($_SESSION["perfil"]=="Administrador" || $_SESSION["perfil"] == "Encargado"){
             echo '<li><a href="categorias"><i class="glyphicon glyphicon-th-list"></i> Categorias</a></li>';
            }
            echo '<li class="active"><a href="repuestos"><i class="fa fa-wrench"></i> Repuestos</a></li>
          </ul>

        </li>';
  }

  if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Encargado" || $_SESSION["perfil"] == "Mecanico"){
       echo '<li class="treeview">
            <a href="#">
                <i class="fa fa-gears"></i>
                <span>Trabajos</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            <li> <a href="ordentrabajo"><i class="fa fa-gear"></i><span>Crear orden de trabajo</span></a></li>
            <li> <a href="admordentra"><i class="fa  fa-file-text-o"></i><span>Administrar orden de trabajo</span></a></li>';
            if($_SESSION["perfil"] == "Administrador"){
             echo '<li> <a href="reportes"><i class="fa fa-line-chart"></i><span>Reporte de orden de trabajo</span></a></li>';
            }
             echo '</ul>
        </li>';
  }
  if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Encargado"){     
       echo '<li>
            <a href="clientes">
                <i class="fa fa-users"></i>
                <span>Clientes</span>
            </a>
        </li>
        <li>
            <a href="vehiculos">
                <i class="fa fa-car"></i>
                <span>Vehiculos</span>
            </a>
        </li>';
  }
  if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Encargado"){ 
        echo '<li> 
            <a href="servicios">
                <i class="glyphicon glyphicon-briefcase"></i>
                <span>Servicios</span>
            </a>
        </li>';
  }
  if($_SESSION["perfil"] == "Administrador"){ 
      echo '<li>
            <a href="mecanicos">
                <i class="fa fa-users"></i>
                <span>Mecanicos</span>
            </a>
        </li>';
  }
  if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Encargado"){ 
    echo '<li class="treeview">
        <a href="#">
            <i class="fa fa-calendar"></i>
            <span>Citas</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
         </a>
         <ul class="treeview-menu">
           <li> <a href="citas">
              <i class="fa fa-calendar-plus-o"></i>
              <span>Crear Citas</span>
            </a>
          </li>
          <li>
          <a href="admcitas">
          <i class="fa fa-calendar-plus-o"></i>
          <span>Administrar Citas</span>
         </a>
         </li>
      </ul>
      </li>';
}
?>
  ?>
  

        </ul>


    </section>


</aside>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar repuestos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar repuestos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarRepuesto">
          
          Agregar repuesto

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Tipo de repuesto</th>
           <th>Marca</th>
           <th>Stock</th>
           <th>Precio de compra</th>
           <th>Precio de venta</th>
           <th>Categoria</th>
           <th>Imagen</th>
           <th>Observación</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <!--   <tbody>
        <?php

              $item = null;

              $valor = null;

              $repuestos = ControladorRepuestos::ctrMostrarRepuestos($item, $valor);
              foreach ($repuestos as $key => $value) {
                echo ' <tr>
                        <td>'.($key+1).'</td>
                       <td>'.$value["tipo_repuesto"].'</td>
                       <td>'.$value["marca"].'</td>
                       <td>'.$value["stock"].'</td>
                       <td>'.$value["precio_compra"].'</td>
                       <td>'.$value["precio_venta"].'</td>';

                       $item = "id_categoria";
                       $valor = $value["id_categoria"];
     
                       $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                       
                       echo '<td>'.$categoria["categoria"].'</td>
                       <td><img src="vistas/img/repuestos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                       <td>'.$value["observacion"].'</td>
                       <td>
    
                         <div class="btn-group">
                      
                           <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
    
                           <button class="btn btn-danger"><i class="fa fa-times"></i></button>
    
                         </div>  
    
                        </td>
    
                      </tr>';
              }
         ?>
          
         



        </tbody-->

       </table>

       <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR REPUESTO
======================================-->

<div id="modalAgregarRepuesto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar repuesto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
          <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaCategoria"  name="nuevaCategoria" required>
                
                <option value="">Selecionar categoría</option>
                  
                <?php

                    $item = null;
                      $valor = null;

                      $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                      foreach ($categorias as $key => $value) {
  
                        echo '<option value="'.$value["id_categoria"].'">'.$value["categoria"].'</option>';
                      }

                ?>

                </select>

              </div>

              </div>
            
            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" readonly required>

              </div>

            </div>


            <!-- ENTRADA PARA EL TIPO DE REPUESTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-cogs"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTRepuesto" placeholder="Ingresar tipo de repuesto" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA MARCA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-tag"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresar marca" required>

              </div>

            </div>
  
            <!-- ENTRADA PARA LA DESCRIPCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaObs" placeholder="Ingresar descripción" required>

              </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

              </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-6 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevoPrecioCompra"  id="nuevoPrecioCompra" min="0"  step="any" placeholder="Precio de compra" required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-6 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" name="nuevoPrecioVenta"  id="nuevoPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX PARA PORCENTAJE -->

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- ENTRADA PARA PORCENTAJE -->

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/repuestos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

      </form>
      <?php

$crearProducto = new ControladorRepuestos();
$crearProducto -> ctrCrearRepuesto();

?> 
            
    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR REPUESTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar repuesto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
          <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg"   name="editarCategoria" readonly required>
                
                <option id="editarCategoria"></option>
                  
       
                </select>

              </div>

              </div>
            
            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo"  readonly required>

              </div>

            </div>


            <!-- ENTRADA PARA EL TIPO DE REPUESTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-cogs"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTRepuesto" id="editarTRepuesto" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA MARCA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-tag"></i></span> 

                <input type="text" class="form-control input-lg" name="editarMarca" id="editarMarca"  required>

              </div>

            </div>
            

            <!-- ENTRADA PARA LA DESCRIPCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="editarObs" id="editarObs" required>

              </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" name="editarStock" id="editarStock" min="0" required>

              </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-6 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" name="editarPrecioCompra"  id="editarPrecioCompra" min="0"  step="any"  required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-6 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" name="editarPrecioVenta"  id="editarPrecioVenta" min="0" step="any" readonly required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX PARA PORCENTAJE -->

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- ENTRADA PARA PORCENTAJE -->

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="editarImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/repuestos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              
              <input type="hidden" name="imagenActual" id="imagenActual">
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>
      <?php

          $editarProducto = new ControladorRepuestos();
          $editarProducto -> ctrEditarProducto();

        ?> 
            
    </div>

  </div>

</div>


<?php

  $eliminarProducto = new ControladorRepuestos();
  $eliminarProducto -> ctrEliminarProducto();

?>  