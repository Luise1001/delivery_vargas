$(document).on('click', '#agregar_tarifa', function()
{
    let funcion = 'nueva_tarifa';
    
    let servicio = $('#tipo_servicio').val();
    let de_km = $('#de_km').val();
    let hasta_km = $('#hasta_km').val();
    let precio = $('#precio').val();

    $.ajax
    ({
       url: '../../server/functions/agregar.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
          funcion: funcion,
          de_km: de_km,
          hasta_km: hasta_km,
          servicio: servicio,
          precio: precio
       }
  
    })
    .done(function(res)
    {
       let titulo = res.titulo;
       let cuerpo = res.cuerpo;
       let accion = res.accion;
       
       if(accion === 'success')
       {
         lista_de_tarifas();
       }
       else
       {
          swal(titulo, cuerpo, accion);
       }
    
        
    })
    .fail(function(err)
    {
      console.log(err);
    })
})