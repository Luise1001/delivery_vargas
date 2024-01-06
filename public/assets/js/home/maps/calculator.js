var mylatlng = { lat: 10.5942341, lng: -67.0501904 };
var mapOptions =
{
  center: mylatlng,
  zoom: 18,
  mapTypeId: google.maps.MapTypeId.ROADMAP,
};

let marker;
var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
marker = new google.maps.Marker({ map: map, position: mylatlng });

$(document).on('click', '#calcular', async function () {
  Trazar_ruta();
})

async function Trazar_ruta() {
  let origen = $('#from').val();
  let destino = $('#to').val();

  if (origen != '' && destino != '') {

    const resp = await calcRoute(origen, destino, mapOptions);

    salida = resp.salida;
    destino = resp.destino;
    let distancia = resp.distancia;
    let tiempo = resp.tiempo;
    let tarifa = await calctarifa(distancia);
    let url_ruta = "https://www.google.com/maps/dir/?api=1&origin=" + salida + "&destination=" + destino + "&travelmode=DRIVING";

    $('#salida').html(salida);
    $('#destino').html(destino);
    $('#distancia').html(distancia + ' Km.');
    $('#tiempo').html('El tiempo Estimado es de ' + tiempo);
    $('#tarifa').html('La Tarifa es de $' + tarifa);
  }
  else {
    swal('Alerta!', 'Debe Ingresar Datos Validos.', 'warning');
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

$(document).ready(GetCurrentLocation())

function GetCurrentLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(async function (e) {
            mylatlng.lat = e.coords.latitude;
            mylatlng.lng = e.coords.longitude;

            var mapOptions =
            {
                center: mylatlng,
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            };
        
            const resp = await geocoding_mylatlng(mylatlng, mapOptions);
            // latitude.value = resp.lat;
            // longitude.value = resp.lng;
            // address.value = resp.direction;

            $('#from').val(resp.direction);
        })
    }
    else {
        console.log("Este Navegador No Soporta Geolocalizacion");
    }
}

map.addListener("click", async function (e) {
  mylatlng.lat = e.latLng.lat();
  mylatlng.lng = e.latLng.lng();

  var mapOptions =
  {
      center: mylatlng,
      zoom: 18,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
  };

  marker.setMap(null)

  const resp = await geocoding_mylatlng(mylatlng, mapOptions);
  // latitude.value = resp.lat;
  // longitude.value = resp.lng;
  //address.value = resp.direction;

  $('#to').val(resp.direction);
})