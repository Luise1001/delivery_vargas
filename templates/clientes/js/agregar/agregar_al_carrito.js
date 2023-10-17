function AddToCar(id_comercio, id_producto, cantidad)
{
  let funcion = 'agregar_al_carrito';

  $.ajax
  ({
     url: '../../server/functions/agregar.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       funcion : funcion,
       id_comercio: id_comercio,
       id_producto: id_producto,
       cantidad: cantidad
    }

  })
  .done(function(res)
  {
    ItemsInCar();
    if(typeof mi_carrito === 'function')
    {
       mi_carrito();
    }
  })
  .fail(function(err)
  {
    console.log(err);
  })
}

function ItemsInCar()
{
    let funcion = 'ItemsInCar';


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
        if(res > 0)
        {
            $('.car-badge').removeClass('visually-hidden');
            $('.car-badge').html(res);
        }
        else
        {
            $('.car-badge').addClass('visually-hidden');
        }

    })
    .fail(function(err)
    {
      console.log(err);
    })
}

let continuar = false;

$(document).on('click', '.add-to-car-button', async function(e)
{
     let button = e.currentTarget.id;
     let codigo = e.currentTarget.attributes.codigo.value;
     let id_comercio = e.currentTarget.attributes.comercio.value;
     let id_producto = e.currentTarget.attributes.producto.value;
     let cantidad = 1;
     let checkPD = await CheckClient();
     
     if(checkPD == true)
     {
        let horario = await CheckSchedule(id_comercio);
        if(horario == true || continuar == true)
        {
          AddToCar(id_comercio, id_producto, cantidad);
          ShowHideButtons(codigo, cantidad);
        }
        else
        {
          swal('ATENCIÓN','No Estamos Disponibles Por El Momento, Si Desea Puede Continuar Con Su Compra y Procesaremos Su Pedido Tan Pronto Como Sea posible.', 'warning',
          {
            buttons: {
              cancel: 'Atrás',
              Continuar: true,
            },
          })
          .then((value) => 
          {
            switch (value) {
           
              case "Continuar":
                continuar = true;
                AddToCar(id_comercio, id_producto, cantidad);
                ShowHideButtons(codigo, cantidad);

                break;
                
              default: false;
            }
          });
        }


     }
     else
     {
      swal('ATENCIÓN','Primero Debe Registrar Sus Datos Personales', 'warning',
      {
        buttons: {
          cancel: 'Atrás',
          Aceptar: true,
        },
      })
      .then((value) => 
      {
        switch (value) {
       
          case "Aceptar":
            window.location.href = 'mi_perfil';
            break;
            
          default: false;
        }
      });

      
     }

})

function ShowHideButtons(codigo, cantidad)
{ 
   let AddToCar = document.querySelector('#add_to_car_'+codigo);
   let buttons_plus_less = document.querySelector('#plus_less_'+codigo);

   if(cantidad > 0)
   {
    AddToCar.setAttribute('hidden', true);
    buttons_plus_less.removeAttribute('hidden');
   }
   else
   {
    if(buttons_plus_less != null && AddToCar != null)
    {
      buttons_plus_less.setAttribute('hidden', true);
      AddToCar.removeAttribute('hidden');
    }
   }

}

$(document).on('click', '.plus-button', function(e)
{
    let button = e.currentTarget.id;
    let codigo = e.currentTarget.attributes.codigo.value;
    let id_comercio = e.currentTarget.attributes.comercio.value;
    let id_producto = e.currentTarget.attributes.producto.value;
    let span = SpanQuantity(codigo);
    let cantidad = PlusButtons(codigo, span);
    AddToCar(id_comercio, id_producto, cantidad);
})

function PlusButtons(codigo, span)
{
   span += 1;

  $('#span_quantity_'+codigo).html(span);

  return span;
}

$(document).on('click', '.less-button', function(e)
{
    let button = e.currentTarget.id;
    let codigo = e.currentTarget.attributes.codigo.value;
    let id_comercio = e.currentTarget.attributes.comercio.value;
    let id_producto = e.currentTarget.attributes.producto.value;
    let span = SpanQuantity(codigo);
    let cantidad = LessButtons(codigo, span);
    AddToCar(id_comercio, id_producto, cantidad);
})

function LessButtons(codigo, cantidad)
{
  if(cantidad > 0)
  {
    cantidad -= 1;

    $('#span_quantity_'+codigo).html(cantidad);
  }

  if(cantidad <= 0)
  {
    ShowHideButtons(codigo, cantidad);
  }

  return cantidad;

}

function SpanQuantity(codigo)
{
  let cantidad = $('#span_quantity_'+codigo).text();
  cantidad = parseInt(cantidad);

  return cantidad;
}

async function CheckClient()
{
  let funcion = 'CheckClient';
  let tabla = 'clientes';
  const resp = 
  $.ajax
  ({
     url: '../../server/functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       funcion : funcion,
       tabla: tabla
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

  return await resp;
}

async function CheckSchedule(id_comercio)
{
  let funcion = 'ChequearHorario';

  const resp = 
  $.ajax
  ({
     url: '../../server/functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       funcion : funcion,
       id_comercio: id_comercio
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

  return await resp;
}