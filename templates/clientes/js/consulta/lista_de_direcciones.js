$(document).ready(lista_de_direcciones());

function lista_de_direcciones()
{ 
   funcion = 'mis_direcciones';
 
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


$(document).on('click', '.direccion-detalle', function(data)
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
