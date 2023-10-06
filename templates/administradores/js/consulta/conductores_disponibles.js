let pedido = 0;

$(document).on('click', '.asignar-conductor', function(e)
{   
   pedido = e.target.id;
   conductores_disponibles(pedido);
});



$(document).on('click', '#asignar', function()
{
   asignar_conductor(pedido);
})

function conductores_disponibles(pedido)
{
   funcion = 'conductores_disponibles';
 
   $.ajax
   ({
      url: '../../server/functions/consultas.php',
      type: 'POST',
      dataType: 'html',
      data: 
      {
        funcion : funcion,
        pedido: pedido
     }
 
   })
   .done(function(res)
   { 
      $('#list_conductores').html(res);
   })
   .fail(function()
   {
     console.log("error ejecutando Ajax");
   })
}

function asignar_conductor(pedido)
{
   let id_conductor = $('#list_conductores').val();
   let funcion = 'elegir_conductor';
   
   $.ajax
   ({
      url: '../../server/functions/editar.php',
      type: 'POST',
      dataType: 'html',
      data: 
      {
         funcion: funcion,
        id_conductor: id_conductor,
        pedido: pedido
     }
 
   })
   .done(function(res)
   { 
      lista_de_envios();
    })
   .fail(function()
   {
     console.log("error ejecutando Ajax");
   })
}

