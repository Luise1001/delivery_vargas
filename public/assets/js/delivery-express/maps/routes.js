var DirectionsService = new google.maps.DirectionsService();
var DirectionsDisplay = new google.maps.DirectionsRenderer();


async function calcRoute(from, to, mapOptions)
{
    
    var respuesta;
    var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
    var request = 
    {
        origin: from,
        destination: to,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
    };

      DirectionsDisplay.setMap(map);

    const resp = await DirectionsService.route(request, async (result, status) =>
    {
        if(status == google.maps.DirectionsStatus.OK)
        {
            DirectionsDisplay.setDirections(result);
            let distancia = result.routes[0].legs[0].distance.value / 1000;
                distancia = Math.round(distancia);
            let tiempo = result.routes[0].legs[0].duration.text;

            respuesta = 
            {
              'salida' : from,
              'destino': to,
              'distancia' : distancia,
              'tiempo': tiempo
                 

            };

            return await respuesta;

        }
        else
        {
            DirectionsDisplay.setDirections({routes: []});
            map.setCenter(mylatlng);
            var marker = new google.maps.Marker({map: map, position: mylatlng});
             console.log('No es posible trazar esta ruta')
        }
    });

    return await respuesta;

}