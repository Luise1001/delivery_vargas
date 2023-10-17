$(document).ready(ShowMap);

function ShowMap() {
  var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
  let marker = new google.maps.Marker({ map: map, position: mylatlng });
}

$(document).ready(function()
{
   let from = $('#from').val();
   let to = $('#to').val();

   if(from && to)
   {
      Trazar_ruta();
   }
});

$(document).on('change', '#from', async function () {
  Trazar_ruta();
});
$(document).on('change', '#to', async function () {
  Trazar_ruta();
});

async function Trazar_ruta() {
  let salida = $('#from').val();
  let destino = $('#to').val();
  let distancia;
  let tiempo;
  let url_ruta;

  if (salida != '' && destino != '') {
    const resp = await calcRoute(salida, destino, mapOptions);

    let respuesta = 
    {
      salida: resp.salida,
      destino: resp.destino,
      distancia: resp.distancia,
      tiempo: resp.tiempo,
      ruta: "https://www.google.com/maps/dir/?api=1&origin=" + salida + "&destination=" + destino + "&travelmode=DRIVING"
    };

    return respuesta;
  }
  else {
    swal('Alerta!', 'Debe Ingresar Datos Validos.', 'warning');
  }
}