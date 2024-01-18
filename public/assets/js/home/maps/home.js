const FormMyLocation = document.getElementById('my-location');
const latitude = document.getElementById('latitude');
const longitude = document.getElementById('longitude');
const address = document.getElementById('address');
const checkbox = document.getElementById('save_location');
const directionName = document.getElementById('name');
const buttonSave = document.getElementById('save');

var mylatlng = { lat: 10.5942341, lng: -67.0501904 };
var mapOptions =
{
    center: mylatlng,
    zoom: 18,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
};
var marker;
var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

$(document).ready(GetCurrentLocation())

function GetCurrentLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (e) {
            mylatlng.lat = e.coords.latitude;
            mylatlng.lng = e.coords.longitude;

            MyMap();
        })
    }
    else {
        console.log("Este Navegador No Soporta Geolocalizacion");
    }
}

async function MyMap() {

    var mapOptions =
    {
        center: mylatlng,
        zoom: 18,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    const resp = await geocoding_mylatlng(mylatlng, mapOptions);
    latitude.value = resp.lat;
    longitude.value = resp.lng;
    address.value = resp.direction;
    
    SaveLocation();
}

var options =
{
    componentRestrictions: { country: "ve"},
    fields: ["place_id", "geometry", "icon", "name"]
}

var input = document.getElementById("address");
autocomplete(input, options);

$(document).on('change', '#address', async function () {
    var mapOptions =
    {
        center: mylatlng,
        zoom: 18,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    var direction = address.value;

    const resp = await geocoding_address(direction, mapOptions);
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
    latitude.value = resp.lat;
    longitude.value = resp.lng;
    address.value = resp.direction;
})

$(document).on('click', '#confirm_location', function () {
    confirm_location();
})

async function confirm_location() {
    var mapOptions =
    {
        center: mylatlng,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    var direction = address.value;

    const resp = await geocoding_address(direction, mapOptions);
    latitude.value = resp.lat;
    longitude.value = resp.lng;
    address.value = resp.direction;
    console.log(resp);
    FormMyLocation.submit();
}

$(checkbox).on('click', function()
{
    if(checkbox.checked)
    {
        $('#direction_name').removeClass('d-none');
        $('#save').removeClass('d-none');
        $('#confirm_location').addClass('d-none');
    }
    else
    {
       $('#direction_name').addClass('d-none');
       $('#save').addClass('d-none');
       $('#confirm_location').removeClass('d-none');
    }
})



buttonSave.addEventListener('click', function (e)
{  e.preventDefault();
    
    form = document.getElementById('form-static-location');

    form.appendChild(directionName);
    form.appendChild(longitude);
    form.appendChild(latitude);
    form.appendChild(address);
    form.submit();
})