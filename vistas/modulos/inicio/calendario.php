<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->

              <div id="calendar"></div>

            </div>
       
          </div>
          
        </div>
       
      </div>
    
    </section>


    
<script>
    /* iniciar calendario
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
        hiddenDays:[0],
        defaultView: 'agendaWeek',
        dayClick:function(date,jsEvent,view){
            $('#modalAgregarCita').modal();
            
            var fecha= date.format();
     
            fecha=fecha.split("T");
            var dia=fecha[0];
            var hora=(fecha[1].split(":"));
            var h1=hora[0];
           
            h1 = h1+":00:00";

            var fechaH= dia+" "+h1;
            $('#nuevoFechaH').val(fechaH);
        },
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'hoy',
        month: 'mes',
        week : 'semana',
        day  : 'día'
      },
      
      events    : [
          <?php
            $item=null;
            $valor=null;
            $citas = ControladorCitas::ctrMostrarCitas($item,$valor);


            foreach ($citas as $key => $value) {
                $itemC = "id_cliente";
                $valorC = $value["id_cliente"];
    
                 $cliente = ControladorClientes::ctrMostrarClientes($itemC, $valorC);
                
                $horafin=intval(substr($value["fecha"],11,2))+1;

                if ($horafin>9) {
                    $fechafin = substr($value["fecha"],0,10)." ".$horafin.":00:00";
                }else{
                    $fechafin = substr($value["fecha"],0,10)." 0".$horafin.":00:00";
                }

                    echo "{
                        title          : '".$cliente["nombre"]."  ".$value["descripcion"]."',
                        start          : '".$value["fecha"]."',
                        end            : '".$fechafin."',
                        backgroundColor: '#00a65a',
                        borderColor    : '#00a65a' 
                    },";
            }
          
          ?>
  
      ]
    })

</script>