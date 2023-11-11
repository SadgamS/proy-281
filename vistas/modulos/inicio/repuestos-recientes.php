<?php



$repuestos = ControladorRepuestos::ctrMostrarRepuestosU();

 ?>

<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Repuestos recientemente agregados</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse">

        <i class="fa fa-minus"></i>

      </button>

      <button type="button" class="btn btn-box-tool" data-widget="remove">

        <i class="fa fa-times"></i>

      </button>

    </div>

  </div>
  
  <div class="box-body">

    <ul class="products-list product-list-in-box">

    <?php

    for($i = 0; $i < 5; $i++){

      echo '<li class="item">

        <div class="product-img">

          <img src="'.$repuestos[$i]["imagen"].'" alt="Product Image">

        </div>

        <div class="product-info">

          <a href="" class="product-title">

            '.$repuestos[$i]["tipo_repuesto"].'

            <span class="label label-warning pull-right">Bs. '.$repuestos[$i]["precio_venta"].'</span>

          </a>
    
       </div>

      </li>';

    }

    ?>

    </ul>

  </div>

  <div class="box-footer text-center">

    <a href="repuestos" class="uppercase">Ver todos los repuestos</a>
  
  </div>

</div>
