async function geocoding_mylatlng(mylatlng, mapOptions) {
    var geocoder = new google.maps.Geocoder();

    var respuesta;

    const resp = await geocoder.geocode({ location: mylatlng }).then(async (response) => {
        if (response.results[0]) {

            marker = new google.maps.Marker({ position: mylatlng, map: map });
            map.setCenter(mylatlng);
            
            let direction = response.results[0].formatted_address;
            let lat = mylatlng.lat;
            let lng = mylatlng.lng;

            respuesta =
            {
                'lat': lat,
                'lng': lng,
                'direction': direction

            };
            return await respuesta;
        }
        else {
            console.log('No results Found');
        }
    })
        .catch((e) => console.log('Geocoder Failed by: ' + e));
    return resp;
}

async function geocoding_address(address, mapOptions) {
    var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
    var geocoder = new google.maps.Geocoder();
    var direction;
    var marker;
    var respuesta;


    const resp = await geocoder.geocode({ 'address': address }, async function (results, status) {
        if (status == 'OK') {
            direction = results[0].geometry.location;
            map.setCenter(direction);
            marker = new google.maps.Marker({ map: map, position: direction });
  
            let lat = marker.getPosition().lat();
            let lng = marker.getPosition().lng();

            respuesta =
            {
                'lat': lat,
                'lng': lng,
                'direction': address
            };

            return await respuesta;
        }
        else {
            console.log('Geocode failed by: ' + status)
        }
    })
    return respuesta;
}