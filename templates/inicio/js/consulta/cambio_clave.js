$(document).ready(cambio_clave());

function cambio_clave()
{
    let funcion = 'cambio_clave';
  
    $.ajax
    ({
       url: '../../server/functions/consultas.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
         funcion: funcion
      }
  
    })
    .done(function(res)
    {
      $('.titulo-app').html(res.titulo);
    })
    .fail(function(err)
    {
      console.log(err);
    })
}