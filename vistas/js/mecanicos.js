/*=============================================
EDITAR MECANICO
=============================================*/
$(".tablas").on("click", ".btnEditarMecanico", function(){

	var idMecanico = $(this).attr("idMecanico");

	var datos = new FormData();
    datos.append("idMecanico", idMecanico);

    $.ajax({

      url:"ajax/mecanicos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

           $("#idMecanico").val(respuesta["id_mecanico"]);
           $("#editarDocumentoId").val(respuesta["ci"]);
	       $("#editarNombre").val(respuesta["nombre"]);
	       $("#editarApellido").val(respuesta["apellido"]);
	       $("#editarTelefono").val(respuesta["telefono"]);
	       $("#editarDireccion").val(respuesta["direccion"]);
	  }

  	})

})

/*=============================================
ACTIVAR MECANICO
=============================================*/
$(document).on("click", ".btnActivarM", function(){

	var idMecanico = $(this).attr("idMecanico");
	var estadoMecanico = $(this).attr("estadoMecanico");

	var datos = new FormData();
 	datos.append("activarId", idMecanico);
  	datos.append("activarMecanico", estadoMecanico);

  	$.ajax({

	  url:"ajax/mecanicos.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      	if(window.matchMedia("(max-width:767px)").matches){
		
      		 swal({
		      	title: "El mecanico ha sido actualizado",
		      	type: "success",
		      	confirmButtonText: "¡Cerrar!"
		    	}).then(function(result) {
		        
		        	if (result.value) {

		        	window.location = "mecanicos";

		        }

		      });


		}
      }

  	})

  	if(estadoMecanico == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Ocupado');
  		$(this).attr('estadoMecanico',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Disponible');
  		$(this).attr('estadoMecanico',0);

  	}

})

/*=============================================
ELIMINAR MECANICO
=============================================*/
$(".tablas").on("click", ".btnEliminarMecanico", function(){

	var idMecanico = $(this).attr("idMecanico");
	
	swal({
        title: '¿Está seguro de borrar el mecanico?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar mecanico!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=mecanicos&idMecanico="+idMecanico;
        }

  })

})