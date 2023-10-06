$(document).on('click', '#agregar_tarifa', function()
{
    let funcion = 'nueva_tarifa';
    
    let km = $('#de_km').val();
    let precio = $('#precio').val();

    $.ajax
    ({
       url: '../../server/functions/agregar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          funcion: funcion,
          km: km,
          precio: precio
       }
  
    })
    .done(function(res)
    {
       swal('Operación Exitosa', '', 'success');
    
        lista_de_tarifas() 
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
})