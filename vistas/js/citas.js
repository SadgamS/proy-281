/*=============================================
EDITAR CITAS
=============================================*/
$(".tablas").on("click", ".btnEditarCita", function(){

	var idCita = $(this).attr("idCita");

	var datos = new FormData();
    datos.append("idCita", idCita);

    $.ajax({

      url:"ajax/citas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        var datosCliente = new FormData();
        datosCliente.append("idCliente",respuesta["id_cliente"]);

        $.ajax({

            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: datosCliente,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){
                
                $("#editarCcliente").val(respuesta["id_cliente"]);
                $("#editarCcliente").html(respuesta["nombre"]);

            }

        })


           $("#idCita").val(respuesta["id_cita"]);
	       $("#editarFechaH").val(respuesta["fecha"]);
	       $("#editarDesc").val(respuesta["descripcion"]);
	
	  }

  	})

})
/*=============================================
ELIMINAR CITA
=============================================*/
$(".tablas").on("click", ".btnEliminarCita", function(){

	var idCita = $(this).attr("idCita");
	
	swal({
        title: '¿Está seguro de borrar la cita?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cita!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=admcitas&idCita="+idCita;
        }

  })

})
