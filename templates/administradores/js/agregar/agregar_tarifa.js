$(document).on('click', '#agregar_tarifa', function()
{
    let page = 'nueva_tarifa';
    
    let km = $('#de_km').val();
    let precio = $('#precio').val();

    $.ajax
    ({
       url: '../../functions/agregar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          page: page,
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