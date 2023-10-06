$(document).ready(lista_de_pedidos());

function lista_de_pedidos()
{ 
   funcion = 'mis_pedidos';
 
  $.ajax
  ({
     url: '../../server/functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       funcion : funcion
    }

  })
  .done(function(res)
  { 
    $('#pendientes').html(res.pendientes);
    $('#completados').html(res.completados);
    $('#anulados').html(res.anulados);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).on('click', '.ws-btn-pedidos', function(data)
{
   ContactoWhatsapp(data);
})

function ContactoWhatsapp(data)
{
  let telefono = data.currentTarget.attributes.telefono.value;
  
  window.location.href = "https://api.whatsapp.com/send/?phone="+telefono+"&text=&type=phone_number&app_absent=0"
}