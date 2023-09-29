$(document).ready(showMap(mapOptions));
$(document).ready(getPrincipalLocation());
$(document).ready(metodos_de_pago());

let salida = '';
let destino = '';
let distancia = '';
let tiempo = '';
let tarifa = '';
let url_ruta = '';


$(document).on('click', '#buscar', async function()
{
    let origen = $('#from').val();
    let destino = $('#to').val();

    if(origen != '' && destino != '')
    {
      const resp = await  calcRoute(origen, destino, mapOptions);
      
        salida = resp.salida;
        destino = resp.destino;
        distancia = resp.distancia;
        tiempo = resp.tiempo;
        tarifa = calctarifa(distancia);
        url_ruta = "https://www.google.com/maps/dir/?api=1&origin=" + salida + "&destination=" + destino +"&travelmode=DRIVING";

        const output = document.querySelector("#output");
        output.innerHTML = "<div>Punto de Partida: " + salida + ".<br/> Destino: " + destino + ".<br/> Distancia <i class='fas fa-road'></i>: " + distancia + " km" + ".<br/> Tiempo Estimado: <i class='fas fa-hourglass-half'></i>: " + tiempo + ".<br/> Total a pagar <i class='fas fa-dollar-sign'></i>: " + tarifa + "</div>"  


    }
    else
    {
      swal('Alerta!','Debe Ingresar Datos Validos.', 'warning');
    }
});


function showMap()
{
  let marker;
  var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
   marker = new google.maps.Marker({map: map, position: mylatlng});
}

var options = 
{
    componentRestrictions: { country: "ve" },
    fields: ["place_id", "geometry", "icon", "name"]
}

var input1 = document.getElementById("from");
var autocomplete1 = autocomplete(input1, options);

var input2 = document.getElementById("to");
var autocomplete2 = autocomplete(input2, options);

function getPrincipalLocation()
{ 
    page = 'direccion_principal';
   

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
      $('#from').val(res)
  
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}

function calctarifa(distancia)
{ 
    page = 'calcular_tarifa';
    let tarifa = 0;
 
    $.ajax
    ({
       url: '../../functions/consultas.php',
       type: 'POST',
       async: false,
       dataType: 'html',
       data: 
       {
         page : page,
         distancia: distancia
      }
  
    })
    .done(function(res)
    { 
      tarifa = res;
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
    return tarifa;

}

$(document).on('click', '#enviar', function(e)
{
  e.preventDefault();
  let origen = $('#from').val();
  let destino = $('#to').val();
  
  if(origen != '' && destino != '')
  {
    let tipo_solicitud = $('#tipo_solicitud').val();

    verificar_datos();
  }
  else
  {
    swal('Alerta!', 'Debe llenar los campos obligaríos marcados con *', 'warning');
  }
})



function verificar_datos()
{
  page = 'llenar_ficha_cliente';

  $.ajax
  ({
     url: '../../functions/verificar.php',
     type: 'POST',
     async: false,
     dataType: 'json',
     data: 
     {
        page: page,
     }

  })
  .done(function(res)
  {
    if(res)
    { 
      enviarSolicitud()
    }
  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");

      window.location.href = "ficha_cliente";
  })
}

function enviarSolicitud()
{
   page = 'nueva_encomienda';
   salida = $('#from').val();
   destino = $('#to').val();
   metodo_pago = $('#metodo_pago').val();
   comentario = $('#comentario').val();
   let referencia = '';

   if(document.getElementById('referencia') !== null)
   {
      referencia = $('#referencia').val();
   }


  $.ajax
  ({
     url: '../../functions/agregar.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
        page: page,
        salida: salida,
        destino: destino,
        distancia: distancia,
        tiempo: tiempo,
        tarifa: tarifa,
        url_ruta: url_ruta,
        metodo_pago: metodo_pago,
        comentario: comentario,
        referencia: referencia
     }

  })
  .done(function(res)
  { console.log(res)
    swal('Operacion Exitosa', '', 'success');
  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}

function metodos_de_pago()
{
  let page = 'metodos_de_pago';

 $.ajax
 ({
    url: '../../functions/consultas.php',
    type: 'POST',
    dataType: 'html',
    data: 
    {
       page: page
    }

 })
 .done(function(res)
 { 
    $('#metodo_pago').html(res);
 })
 .fail(function(res)
 {
   console.log("error ejecutando Ajax");
 })
}

$(document).on('click', '#metodo_pago', function()
{
  let tipo_pago = $('#metodo_pago').val();
   show_data_bank(tipo_pago)
})


function show_data_bank(tipo_pago)
{
  let page = 'datos_bancarios';

  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
        page: page,
        tipo_pago: tipo_pago
     }
 
  })
  .done(function(res)
  { 
     $('#datos_bancarios').html(res);
  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}

$(document).on('keydown', '#referencia', function(e)
{
   let input = document.getElementById('referencia');
   let valor = input.value.length;

   if(valor === 6)
   {
     input.disabled = true;
   }
   
})