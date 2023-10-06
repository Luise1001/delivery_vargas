let id_tarifa = 0;

$(document).on('click', '#editar_tarifa_btn', function(data)
{ 
    $('#editar_de_km').val(data.target.parentNode.attributes.km.value);
    $('#editar_precio').val(data.target.parentNode.attributes.precio.value);;
    id_tarifa = data.target.parentNode.attributes.tarifa.value;

})

$(document).on('click', '#modificar_tarifa', function()
{
   let km =  $('#editar_de_km').val();
   let precio = $('#editar_precio').val();

   let funcion = 'editar_tarifa';

    $.ajax
    ({
       url: '../../server/functions/editar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         funcion: funcion,
         id_tarifa: id_tarifa,
         km: km,
         precio: precio
       }
  
    })
    .done(function(res)
    {
        lista_de_tarifas() 
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
})