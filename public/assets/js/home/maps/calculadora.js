$(document).ready(showMap());

function showMap()
{
  let marker;
  var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
   marker = new google.maps.Marker({map: map, position: mylatlng});
}

$(document).on('click', '#calcular', async function()
{
   Trazar_ruta();
})

async function Trazar_ruta()
{
  let origen = $('#from').val();
  let destino = $('#to').val();

  if(origen != '' && destino != '')
  {

    const resp = await  calcRoute(origen, destino, mapOptions);
    
      salida = resp.salida;
      destino = resp.destino;
      let distancia = resp.distancia;
      let tiempo = resp.tiempo;
      let tarifa = await calctarifa(distancia);
      let url_ruta = "https://www.google.com/maps/dir/?api=1&origin=" + salida + "&destination=" + destino +"&travelmode=DRIVING";

      $('#salida').html(salida);
      $('#destino').html(destino);
      $('#distancia').html(distancia + ' Km.');
      $('#tiempo').html('El tiempo Estimado es de ' + tiempo);
      $('#tarifa').html('La Tarifa es de $'+tarifa);
  }
  else
  {
    swal('Alerta!','Debe Ingresar Datos Validos.', 'warning');
  }
}

var options = 
{
    componentRestrictions: { country: "ve" },
    fields: ["place_id", "geometry", "icon", "name"]
}

var input1 = document.getElementById("from");
var autocomplete1 = autocomplete(input1, options);

var input2 = document.getElementById("to");
var autocomplete2 = autocomplete(input2, options);

function calctarifa(distancia)
{ 
  let servicio = $('#tipo_servicio').val();
  let funcion = 'calcular_tarifa';
  
 
   const tarifa =  $.ajax
    ({
       url: '../../server/functions/consultas.php',
       type: 'POST',
       async: false,
       dataType: 'html',
       data: 
       {
         funcion : funcion,
         distancia: distancia,
         servicio: servicio
      }
  
    })
    .done(function(res)
    {  

      return res;
    })
    .fail(function(err)
    {
      console.log(err);
    })

    return tarifa;
}