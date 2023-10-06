$(document).ready(lista_metodos_de_pago());

function lista_metodos_de_pago()
{
    let funcion = 'metodos_de_pago';

    $.ajax
    ({
       url: '../../server/functions/consultas.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         funcion : funcion
      }
  
    })
    .done(function(res)
    {
      $('#resp').html(res);
  
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}