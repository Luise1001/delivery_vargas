$(document).ready(showMap(mapOptions));

let salida = '';
let destino = '';
let distancia = '';
let tiempo = '';
let tarifa = '';
let url_ruta = '';

$(document).ready(Trazar_ruta());

$(document).on('change', '#from', async function()
{
   Trazar_ruta();
})

$(document).on('change', '#to', async function()
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
      distancia = resp.distancia;
      tiempo = resp.tiempo;
      tarifa = calctarifa(distancia);
      url_ruta = "https://www.google.com/maps/dir/?api=1&origin=" + salida + "&destination=" + destino +"&travelmode=DRIVING";

      const output = document.querySelector("#output");
      output.innerHTML = "<div>Punto de Partida: " + salida + ".<br/> Destino: " + destino + ".<br/> Distancia <i class='fas fa-road'></i>: " + distancia + " km" + ".<br/> Tiempo Estimado: <i class='fas fa-hourglass-half'></i>: " + tiempo + ".<br/> Total a pagar <i class='fas fa-dollar-sign'></i>: " + tarifa + "</div>"  


  }
  else
  {
    swal('Alerta!','Debe Ingresar Datos Validos.', 'warning');
  }
}


function showMap()
{
  let marker;
  var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
   marker = new google.maps.Marker({map: map, position: mylatlng});
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
    funcion = 'calcular_tarifa';
    let tarifa = 0;
    let servicio = $('#tipo_servicio').val();
 
    $.ajax
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
      tarifa = res;
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
    return tarifa;

}