$(document).ready(getCurrentLocation());

$(document).on('click', '#confirm_location', function()
{
    confirm_location();
});

function getCurrentLocation() 
{

  if (navigator.geolocation) 
  {
    navigator.geolocation.getCurrentPosition(showPosition);
  }
   else 
   {
    console.log('Este Navegador No Soporta Geolocalizacion.');
  }

};

function showPosition(position)
{  
    mylatlng = {lat: position.coords.latitude, lng: position.coords.longitude};
    
    indexMap(mylatlng);

};

 async function indexMap(position)
{
  var mylatlng = position;

var mapOptions = 
{
    center: mylatlng,
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
};

  const resp = await geocoding_mylatlng(mylatlng, mapOptions);
  let lat = resp.lat;
  let lng = resp.lng;
  let direction = resp.direction;
  $('#from').val(direction);

  SavePrincipalLocation(lat, lng, direction);

}
  
var options = 
{
    componentRestrictions: { country: "ve" },
    fields: ["place_id", "geometry", "icon", "name"]
}

var input = document.getElementById("from");
 autocomplete(input, options);

async function confirm_location()
{ 
  var mapOptions = 
  {
    center: mylatlng,
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
   };

  var address = $('#from').val();

  const resp = await geocoding_address(address, mapOptions);
  let lat = resp.lat;
  let lng = resp.lng;
  let direction = resp.direction;
  
 let SaveLocation = await SavePrincipalLocation(lat, lng, direction);

 let titulo = SaveLocation.titulo;
 let cuerpo = SaveLocation.cuerpo;
 let accion = SaveLocation.accion;
 let folder = SaveLocation.folder;

   if(accion === 'success')
   {
       window.location.href = `../${folder}/comprar`;
   }
   else
   {
      swal(titulo, cuerpo, accion);
   }

}

async function SavePrincipalLocation(lat, lng, name)
{ 
    let funcion = 'mi_ubicacion_actual';

       const resp =  await $.ajax
        ({
           url: '../../server/functions/agregar.php',
           type: 'POST',
           dataType: 'json',
           data: 
           {
              funcion: funcion,
              lat: lat,
              lng: lng,
              name: name
           }
      
        })
        .done( async function(res)
        {
           return await res;
        })
        .fail(function(err)
        {
          console.log(err);
        })

        return resp;
    
}

