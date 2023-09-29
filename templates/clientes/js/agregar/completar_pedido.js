let nro_pedido = '';
$(document).on('click', '.pagar-pedido', function()
{
   $('.datos-bancarios').html('');
})

$(document).on('click', '.anular-pedido', function(data)
{ 
  nro_pedido = data.currentTarget.attributes.pedido.value;
  
  swal('Seguro que desea Anular','', 'warning',
  {
    buttons: {
      cancel: 'Cancelar',
      Confirmar: true,
    },
  })
  .then((value) => 
  {
    switch (value) {
   
      case "Confirmar":
        anular_pedido(nro_pedido);
        break;
        
      default: false;
    }
  });
})


function anular_pedido(nro_pedido)
{
  page = 'anular_pedido';
 
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
    lista_de_pedidos();
  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}

$(document).on('click', '.pagar-pedido', function(data)
{
   nro_pedido = data.currentTarget.attributes.pedido.value;
   let id_comercio = data.currentTarget.attributes.comercio.value;
   metodos_de_pago(nro_pedido);
   direccion_salida(id_comercio);
})

function metodos_de_pago(nro_pedido)
{
  let page = 'metodos_de_pago';
  $.ajax
  ({
     url: '../../functions/consultas.php',
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
    $('#metodos_pago').html(res);
  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}

$(document).on('change', '#metodos_pago', function()
{
  let opcion = $('#metodos_pago').val();
   datos_pago_pedido(opcion, nro_pedido);
})

function datos_pago_pedido(opcion, nro_pedido)
{
  let page = 'datos_pago_pedido';
 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page,
       opcion: opcion,
       nro_pedido: nro_pedido
    }

  })
  .done(function(res)
  { 
    $('.datos-bancarios').html(res);
  })
  .fail(function(err)
  {
    console.log(err);
  })
}

function direccion_salida(id_comercio)
{
  let page = 'direccion_salida';
 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page,
       id_comercio: id_comercio
    }

  })
  .done(function(res)
  { 
    $('#direccion_salida').val(res);
    let input = document.getElementById('direccion_salida');
    input.setAttribute('hidden', true);
    GenerarRuta();
  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).on('change', '#direccion_envio', function()
{
   GenerarRuta();
})


$(document).ready(direccion_envio());

function direccion_envio()
{
  let page = 'direccion_envio';
 
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
    $('#direccion_envio').html(res);
  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).on('click', '#enviar_pedido', function()
{
    verificar_datos_pedido();
})


async function verificar_datos_pedido()
{
    let page = 'confirmar_pedido';
    let metodo_pago = $('#metodos_pago').val();
    let referencia = $('#referencia_pago').val();
    let direccion = $('#direccion_envio').val();
    let ruta = '';

    if(!referencia)
    {
        if(metodo_pago == '1' || metodo_pago == '2')
        {
            referencia = 0;
            ruta = await GenerarRuta();
            completar_pedido(page,nro_pedido, metodo_pago, referencia, direccion, ruta);
        }
        else
        {
            swal('Cuidado', 'Debe Completar Todos Los Campos Requeridos Con (*)', 'warning');
        }
    }
    else
    {
      ruta = await GenerarRuta();
      completar_pedido(page, nro_pedido, metodo_pago, referencia, direccion, ruta);
    }


}

function completar_pedido(page, nro_pedido, metodo_pago, referencia, direccion, ruta)
{
  $.ajax
  ({
     url: '../../functions/agregar.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page,
       nro_pedido: nro_pedido,
       metodo_pago: metodo_pago, 
       referencia: referencia,
       direccion: direccion,
       ruta: ruta
    }

  })
  .done(function(res)
  {  console.log(res)
    lista_de_pedidos();
  })
  .fail(function(err)
  {
    console.log(err);
  })
}


async function GenerarRuta()
{
  let origen = $('#direccion_salida').val();
  let id_direccion = $('#direccion_envio').val();
  let destino = await RequestDirectionName(id_direccion);
 
  if(origen != '' && destino != '')
  {
    const resp = await  calcRoute(origen, destino, mapOptions);
    
    let url = "https://www.google.com/maps/dir/?api=1&origin=" + resp.salida + "&destination=" + resp.destino +"&travelmode=DRIVING"
    const ruta = 
    {
      salida : resp.salida,
      destino : resp.destino,
      distancia : resp.distancia,
      tiempo : resp.tiempo,
      url_ruta : url
     
    };

    return ruta;

  }
  else
  {

    swal('Alerta!','Debe Ingresar Datos Validos.', 'warning');
    return false;
  }
}


async function RequestDirectionName(id_direccion)
{
  let page = 'nombre_direccion';
  const resp = await $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page,
       id_direccion: id_direccion
    }

  })
  .done(async function(res)
  { 
     return await res;
  })
  .fail(function(err)
  {
    console.log(err);
  })

  return resp;
}