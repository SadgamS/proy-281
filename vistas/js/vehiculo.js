/*=============================================
EDITAR VEHICULO
=============================================*/

$(".tablas").on("click", ".btnEditarVehiculo", function(){

	var idVehiculo = $(this).attr("idVehiculo");
	var datos = new FormData();
    datos.append("idVehiculo", idVehiculo);

     $.ajax({

      url:"ajax/vehiculos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

          var datosVehiculo = new FormData();
          datosVehiculo.append("idCliente",respuesta["id_cliente"]);

           $.ajax({

              url:"ajax/clientes.ajax.php",
              method: "POST",
              data: datosVehiculo,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
				  
                  $("#editarPropietario").val(respuesta["id_cliente"]);
                  $("#editarPropietario").html(respuesta["nombre"]);

              }

          })

          $("#idVehiculo").val(respuesta["id_vehiculo"]);

		   $("#editarPlaca").val(respuesta["placa"]);
		   
		   $("#editarMarca").val(respuesta["marca"]);

		   $("#editarModelo").val(respuesta["modelo"]);

           $("#editarAnho").val(respuesta["anho"]);

           $("#editarColor").val(respuesta["color"]);

           $("#editarKilometraje").val(respuesta["kilometraje"]);

      }

  })

})

/*=============================================
ELIMINAR VEHICULO
=============================================*/
$(".tablas").on("click", ".btnEliminarVehiculo", function(){

	var idVehiculo = $(this).attr("idVehiculo");
	
	swal({
        title: '¿Está seguro de borrar el vehiculo?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar vehiculo!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=vehiculos&idVehiculo="+idVehiculo;
        }

  })

})

	$(document).ready(function(){
	
		recargarLista();

		$('#seleccionarCliente').change(function(){
			recargarLista();
		});
	})


	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"ajax/datos.ajax.php",
			data:"id_cliente=" + $('#seleccionarCliente').val(),
			success:function(r){
				$('#seleccionarVehiculo').html(r);
			}
		});
	}

