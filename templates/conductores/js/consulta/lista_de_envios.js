$(document).ready(mis_envios());

function mis_envios()
{ 
   page = 'mis_envios';
 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       page : page
    }

  })
  .done(function(res)
  { 
    $('#pendientes').html(res.pendientes);
    $('#transito').html(res.transito);
    $('#completados').html(res.completados);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).on('click', '.revisar-ruta', function(data)
{
  revisar_ruta(data);
})

function revisar_ruta(data)
{
  const ruta = data.target.attributes.ruta.value;

  const googleMap = window.open(ruta, '_blank');

}

$(document).on('click', '.aceptar-envio', function(data)
{
   aceptar_envio(data);
})

function aceptar_envio(data)
{
  let ruta = data.target.attributes.ruta.value;
  let nro_pedido = data.target.attributes.pedido.value;

  page = 'aceptar_envio';
 
  $.ajax
  ({
     url: '../../functions/editar.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page,
       nro_pedido: nro_pedido
    }

  })
  .done(function(res)
  {
    mis_envios();

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).on('click', '.ruta-completada', function(data)
{
    ruta_completada(data);
});

function ruta_completada(data)
{
    let nro_pedido = data.target.attributes.pedido.value;
    
    let page = 'ruta_completada';
 
    $.ajax
    ({
       url: '../../functions/editar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         page : page,
         nro_pedido: nro_pedido
      }
  
    })
    .done(function(res)
    {
      window.location.href = "../inicio/inicio";
    })
    .fail(function(err)
    {
      console.log(err);
    })
}


$(document).on('click', '.ws-btn-envios', function(data)
{
   ContactoWhatsapp(data);
})

function ContactoWhatsapp(data)
{
  let telefono = data.currentTarget.attributes.telefono.value;
  
  window.location.href = "https://api.whatsapp.com/send/?phone="+telefono+"&text=&type=phone_number&app_absent=0"
}

$(document).on('click', '.envio-detalle', function(data)
{ 
  let id = data.target.id;
  let id_name = 'detalle_'+id;
  let detalle = document.getElementById(id_name);

  detalle.classList.toggle("active");
  if(detalle.style.display === 'block')
  {
    detalle.style.display = 'none';
  }
  else
  {
    detalle.style.display = 'block';
  }

})

