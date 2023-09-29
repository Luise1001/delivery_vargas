$(document).ready(lista_metodos_de_pago());

function lista_metodos_de_pago()
{
    let page = 'metodos_de_pago';

    $.ajax
    ({
       url: '../../functions/consultas.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         page : page
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