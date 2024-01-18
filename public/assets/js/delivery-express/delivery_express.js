var mylatlng = { lat: 10.5942341, lng: -67.0501904 };
var mapOptions =
{
    center: mylatlng,
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
};

let marker;
var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
marker = new google.maps.Marker({ map: map, position: mylatlng });

var options =
{
    componentRestrictions: { country: "ve" },
    fields: ["place_id", "geometry", "icon", "name"]
}

var input1 = document.getElementById("from");
var autocomplete1 = autocomplete(input1, options);

var input2 = document.getElementById("to");
var autocomplete2 = autocomplete(input2, options);

$('#from').on('change', async function () {
    GenerateRoute();
})

$('#to').on('change', async function () {
    GenerateRoute();
})

map.addListener("click", async function (e) {
    mylatlng.lat = e.latLng.lat();
    mylatlng.lng = e.latLng.lng();

    var mapOptions =
    {
        center: mylatlng,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    marker.setMap(null)

    const resp = await geocoding_mylatlng(mylatlng, mapOptions);

    $('#to').val(resp.direction);

    GenerateRoute();
})

async function GenerateRoute() {
    let origen = $('#from').val();
    let destino = $('#to').val();

    const resp = await calcRoute(origen, destino, mapOptions);

    salida = resp.salida;
    destino = resp.destino;
    let distancia = resp.distancia;
    let tiempo = resp.tiempo;
    let url_ruta = "https://www.google.com/maps/dir/?api=1&origin=" + salida + "&destination=" + destino + "&travelmode=DRIVING";

    const route = {
            'from': salida,
            'to': destino,
            'distance': distancia,
            'duration': tiempo,
            'url_map': url_ruta
        }

        let ruta = JSON.stringify(route);
        $('#route').val(ruta);

}
