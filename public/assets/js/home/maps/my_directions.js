$(document).ready(checkLevel());

$(document).on('click', '#confirm_location', function(e)
{
   e.preventDefault();
   GetMyDirection();
})

$(document).on('click', '#save_location', function()
{
    Checkbox_direction();
})

function checkLevel()
{
    let funcion = 'admin_level';

    $.ajax
    ({
       url: '../../server/functions/consultas.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          funcion: funcion
       }
  
    })
    .done(function(res)
    {
       if(res == 1 || res == 2)
       {
          let sv_label = document.getElementById('save_location_label');
          let sv_location = document.getElementById('save_location');

          sv_label.setAttribute('hidden', true);
          sv_location.setAttribute('hidden', true);
       }
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}

async function GetMyDirection()
{
  const save_location = document.getElementById("save_location");

  if(save_location.checked)
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
    let name = $('#direccion_nombre').val();

    SaveMyDirection(lat, lng, direction, name);
  }

}

function SaveMyDirection(lat, lng, direction, name)
{  console.log(name)
    let funcion = 'nueva_direccion';

        $.ajax
        ({
           url: '../../server/functions/agregar.php',
           type: 'POST',
           dataType: 'html',
           data: 
           {
              funcion: funcion,
              lat: lat,
              lng: lng,
              direction: direction,
              name: name
           }
      
        })
        .done(function(res)
        {
         window.location.reload(true);
        })
        .fail(function()
        {
          console.log("error ejecutando Ajax");
        })
}

function Checkbox_direction()
{
   const save_location = document.getElementById("save_location");

   if(save_location.checked)
   {
      $('#d_name').removeClass('d-none');
   }
   else
   {
      $('#d_name').addClass('d-none');
   }
}