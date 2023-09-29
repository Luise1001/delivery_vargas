let continuar = false;
$(document).ready(catalogo_productos());

function catalogo_productos()
{ 
   page = 'catalogo_productos';
   let id_categoria = $('#categoria').val();
   let id_comercio = $('#comercio').val();

 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page,
       id_categoria: id_categoria,
       id_comercio: id_comercio
    }

  })
  .done(function(res)
  {
    $('.catalogo-productos').html(res);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).on('click', '.add-to-car-button', async function(e)
{
     let button = e.currentTarget.id;
     let codigo = e.currentTarget.attributes.codigo.value;
     let id_comercio = e.currentTarget.attributes.comercio.value;
     let id_producto = e.currentTarget.attributes.producto.value;
     let cantidad = 1;
     let checkPD = await CheckPersonalData();
     
     if(checkPD == true)
     {
        let horario = await ChequearHorario(id_comercio);
        if(horario == true || continuar == true)
        {
          AddToCar(id_comercio, id_producto, cantidad);
          ShowHideButtons(button, codigo);
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
                ShowHideButtons(button, codigo);

                break;
                
              default: false;
            }
          });
        }


     }
     else
     {
      swal('Atención','Primero Debe Registrar Sus Datos Personales', 'warning',
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
            window.location.href = '../clientes/mi_perfil';
            break;
            
          default: false;
        }
      });

      
     }

})

function ShowHideButtons(button, codigo)
{ 
   let AddToCar = document.querySelector('#'+button);
   let buttons_plus_less = document.querySelector('#plus_less_'+codigo);
   AddToCar.setAttribute('hidden', true);
   buttons_plus_less.removeAttribute('hidden');
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

function LessButtons(codigo, span)
{
  if(span > 0)
  {
    span -= 1;

    $('#span_quantity_'+codigo).html(span);
  }

  return span;

}

function SpanQuantity(codigo)
{
  let cantidad = $('#span_quantity_'+codigo).text();
  cantidad = parseInt(cantidad);

  return cantidad;
}

async function CheckPersonalData()
{
  let page = 'check_personal_data';
  let tabla = 'clientes';
  const resp = 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page,
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

async function ChequearHorario(id_comercio)
{
  let page = 'ChequearHorario';

  const resp = 
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

