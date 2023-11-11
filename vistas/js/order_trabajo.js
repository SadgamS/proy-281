if (localStorage.getItem("capturarRango") !=null) {
	$("#daterange-btn span").html(localStorage.getItem("capturarRango"));
}else{
	$("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}



$('.tablaTrabajos').DataTable( {
    "ajax": "ajax/datatable-trabajos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaTrabajos tbody").on("click", "button.agregarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

     	url:"ajax/repuestos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      	    var descripcion = respuesta["tipo_repuesto"];
          	var stock = respuesta["stock"];
          	var precio = respuesta["precio_venta"];

          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

      			swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

			    return;

          	}

          	$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
				  '<input type="text" class="form-control nuevoPrecioProducto np" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
	 
	            '</div>'+
	             
			  '</div>'+

	        '</div>') 

	        // SUMAR TOTAL DE PRECIOS

	        sumarTotalPrecios()

	        // AGREGAR IMPUESTO

	        agregarImpuesto()

	        // AGRUPAR PRODUCTOS EN FORMATO JSON

	       listarProductos()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

			$(".nuevoPrecioProducto").number(true, 2);
			
			localStorage.removeItem("quitarProducto");

      	}

     })

});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaTrabajos").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}


	}


})


/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioTrabajo").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios()

    	// AGREGAR IMPUESTO
	        
        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()

	}

})
/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioTrabajo").on("change", "select.nuevaDescripcionProducto", function(){

	var nombreProducto = $(this).val();

	var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

	var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);


	  $.ajax({

     	url:"ajax/repuestos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	    
      	     $(nuevaDescripcionProducto).attr("idProducto", respuesta["id_repuesto"]);
      	    $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      	    $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
      	    $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
      	    $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

      	}

      })
})
/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/

var numProducto = 0;

$(".btnAgregarProducto").click(function(){

	numProducto ++;

	var datos = new FormData();
	datos.append("traerProductos", "ok");

	$.ajax({

		url:"ajax/repuestos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	    
      	    	$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+

	              '<select class="form-control nuevaDescripcionProducto select2" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+

	              '<option>Seleccione el producto</option>'+

	              '</select>'+  

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3 ingresoCantidad">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock nuevoStock required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>');


	        // AGREGAR LOS PRODUCTOS AL SELECT 

	         respuesta.forEach(funcionForEach);

	         function funcionForEach(item, index){

	         	if(item.stock != 0){

		         	$("#producto"+numProducto).append(

						'<option idProducto="'+item.id_repuesto+'" value="'+item.tipo_repuesto+'">'+item.tipo_repuesto+'</option>'
		         	)

		         }

	         }

	         // SUMAR TOTAL DE PRECIOS

    		sumarTotalPrecios()

    		// AGREGAR IMPUESTO
	        
	        agregarImpuesto()

		
	        $(".nuevoPrecioProducto").number(true, 2);

      	}


	})

})
/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioTrabajo").on("change", "input.nuevaCantidadProducto", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	
	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(1);

		var precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);

		sumarTotalPrecios();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO
	        
    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

	listarProductos()
	
	listarServicios()

})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
	var precioItem2 = $(".nuevoPrecioServicio");
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		 
	}
	for(var i = 0; i < precioItem2.length; i++){

		arraySumaPrecio.push(Number($(precioItem2[i]).val()));
		
   }

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);


	
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto(){

	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
	
	$("#nuevoTotalVenta").val(totalConImpuesto);

	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNeto").val(precioTotal);

}
/*=============================================
AGREGANDO SERVICIOS DESDE EL BOTON
=============================================*/

var numServicio= 0;
$(".btnAgregarServicio").click(function(){

	numServicio ++;


	var datos = new FormData();
	datos.append("traerServicios", "ok");

	$.ajax({

		url:"ajax/servicios.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

		

			$(".nuevoServicio").append(

				'<div class="row" style="padding:5px 15px">'+
  
				'<!-- Servicio -->'+
				
				'<div class="col-xs-6" style="padding-right:0px">'+
				
				  '<div class="input-group">'+
					
					'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarServicio" idServicio><i class="fa fa-times"></i></button></span>'+
  
					'<select class="form-control nuevoNServicio select2"  id="servicio'+numServicio+'"  idServicio name="nuevoServicio" required>'+
  
					'<option>Seleccione el Servicio</option>'+
  
					'</select>'+  
  
				  '</div>'+
  
				'</div>'+
  
  
				'<!-- Precio del servicio -->'+
  
				'<div class="col-xs-3 ingresoPrecioS">'+
  
				  '<div class="input-group ">'+
  
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					   
					'<input type="text" class="form-control nuevoPrecioServicio" precioReal="" name="nuevoPrecioServicio" value="" readonly required>'+
	   
				  '</div>'+
				   
				'</div>'+
  
			  '</div>');

			      // AGREGAR LOS SERVICIOS AL SELECT 

				  respuesta.forEach(funcionForEach);

				  function funcionForEach(item, index){
	 
	 
						$("#servicio"+numServicio).append(
	 
							 '<option idServicio="'+item.id_servicio+'" value="'+item.nombre_servicio+'">'+item.nombre_servicio+'</option>'
						  )

				  }
			  // SUMAR TOTAL DE PRECIOS

			  sumarTotalPrecios()

			  agregarImpuesto()

			    // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

				$(".nuevoPrecioServicio").number(true, 2);

		
		}


	})

})

/*=============================================
SELECCIONAR SERVICIO
=============================================*/

$(".formularioTrabajo").on("change", "select.nuevoNServicio", function(){

	var nombreServicio = $(this).val();

	var nuevoServicio = $(this).parent().parent().parent().children().children().children(".nuevoNServicio");

	var nuevoPrecioServicio = $(this).parent().parent().parent().children(".ingresoPrecioS").children().children(".nuevoPrecioServicio");


	var datos = new FormData();
    datos.append("nombreServicio", nombreServicio);


	  $.ajax({

     	url:"ajax/servicios.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      	    
      	    $(nuevoServicio).attr("idServicio", respuesta["id_servicio"]);
      	    $(nuevoPrecioServicio).val(respuesta["costo"]);
      	    $(nuevoPrecioServicio).attr("precioReal", respuesta["costo"]);


			sumarTotalPrecios()

			listarServicios()

      	}

      })
})

/*=============================================
QUITAR SERVICIOS
=============================================*/



$(".formularioTrabajo").on("click", "button.quitarServicio", function(){

	$(this).parent().parent().parent().parent().remove();
  	// SUMAR TOTAL DE PRECIOS

	  sumarTotalPrecios()

	  // AGREGAR IMPUESTO
		  
	  agregarImpuesto()


	  listarServicios()

})

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").change(function(){

	agregarImpuesto();

});

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalVenta").number(true, 2);

/*=============================================
LISTAR TODOS LOS REPUESTOS
=============================================*/

function listarProductos(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id_repuesto" : $(descripcion[i]).attr("idProducto"), 
							  "tipo_repuesto" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})

	}
	

	$("#listaProductos").val(JSON.stringify(listaProductos)); 

}


/*=============================================
LISTAR TODOS LOS SERVICIOS
=============================================*/

function listarServicios(){

	var listaServicios = [];

	var servicio = $(".nuevoNServicio");

	var precio = $(".nuevoPrecioServicio");

	for(var i = 0; i < servicio.length; i++){

		listaServicios.push({ "id_servicio" : $(servicio[i]).attr("idServicio"), 
							  "servicio" : $(servicio[i]).val(),
							  "precio" : $(precio[i]).attr("precioReal")})

	}
	
	


	$("#listaServicios").val(JSON.stringify(listaServicios)); 

}
/*=============================================
BORRAR ORDEN
=============================================*/
$(".tablas").on("click", ".btnEliminarOrden", function(){

	var idOrden = $(this).attr("idOrden");
  
	swal({
		  title: '¿Está seguro de borrar el orden de trabajo?',
		  text: "¡Si no lo está puede cancelar la accíón!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: 'Si, borrar!'
		}).then(function(result){
		  if (result.value) {
			
			  window.location = "index.php?ruta=admordentra&idOrden="+idOrden;
		  }
  
	})
  
  })
    /*=============================================
VER ORDEN
=============================================*/

$(".tablas").on("click", ".btnVerOrden", function(){

	var codigo = $(this).attr("idOrden");

	window.location = "index.php?ruta=ver_orden&idOrden="+codigo;

})

  /*=============================================
IMPRIMIR ORDEN
=============================================*/

$(".tablas").on("click", ".btnImprimirOrden", function(){

	var codigo = $(this).attr("codigo");

	window.open("extensiones/tcpdf/pdf/orden.php?codigo="+codigo, "_blank");

})

/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn').daterangepicker(
	{
	  "locale":{
		"daysOfWeek": [
			"Do",
			"Lu",
			"Ma",
			"Mi",
			"Ju",
			"Vi",
			"Sa"
		],
		"monthNames": [
			"Enero",
			"Febrero",
			"Marzo",
			"Abril",
			"Mayo",
			"Junio",
			"Julio",
			"Agosto",
			"Setiembre",
			"Octubre",
			"Noviembre",
			"Diciembre"
		]
	  },
	  ranges   : {
		'Hoy'       : [moment(), moment()],
		'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
		'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
		'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
		'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	  },
	  startDate: moment(),
	  endDate  : moment()
	},
	function (start, end) {
	  $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  
	  var fechaInicial = start.format('YYYY-MM-DD');
  
	  var fechaFinal = end.format('YYYY-MM-DD');
  
	  var capturarRango = $("#daterange-btn span").html();
	 
		 localStorage.setItem("capturarRango", capturarRango);
  
		 window.location = "index.php?ruta=admordentra&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  
	}
  
  )
  /*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "admordentra";
})
/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "admordentra";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		if(mes < 10){

			var fechaInicial = año+"-0"+mes+"-"+dia;
			var fechaFinal = año+"-0"+mes+"-"+dia;

		}else if(dia < 10){

			var fechaInicial = año+"-"+mes+"-0"+dia;
			var fechaFinal = año+"-"+mes+"-0"+dia;

		}else if(mes < 10 && dia < 10){

			var fechaInicial = año+"-0"+mes+"-0"+dia;
			var fechaFinal = año+"-0"+mes+"-0"+dia;

		}else{

			var fechaInicial = año+"-"+mes+"-"+dia;
	    	var fechaFinal = año+"-"+mes+"-"+dia;

		}	

    	localStorage.setItem("capturarRango", "Hoy");

    	window.location = "index.php?ruta=admordentra&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})
